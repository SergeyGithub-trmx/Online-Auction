<?php

namespace app\controllers;

use app\models\Category;
use app\models\ClosingReason;
use app\models\Lot;
use app\models\User;
use app\models\forms\CloseLotForm;
use app\models\forms\CreateLotForm;
use app\services\LotService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class LotController extends Controller
{
    public $user;
    const USER_REASON_ID = 1;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['close'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $lot = Lot::findOne(Yii::$app->request->get('lot_id'));
                            $is_owner = $lot->user_id === Yii::$app->user->id;
                            $is_open = is_null($lot->closing_reason_id);
                            return $is_owner && $is_open;
                        }
                    ]
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        $categories = Category::find()->all();
        $create_lot_form = new CreateLotForm();

        if (Yii::$app->request->isPost) {
            $create_lot_form->load(Yii::$app->request->post());
            $create_lot_form->image = UploadedFile::getInstance($create_lot_form, 'image');

            if ($create_lot_form->validate() && (new LotService())->create($create_lot_form)) {
                Yii::$app->session->setFlash('success', 'Лот создан!');
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('create', [
            'categories' => $categories,
            'model' => $create_lot_form
        ]);
    }

    public function actionView(int $lot_id)
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        $lot = Lot::findOne($lot_id);
        
        return $this->render('view', [
            'lot' => $lot
        ]);
    }

    public function actionClose(int $lot_id)
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        $close_lot_form = new CloseLotForm();
        $close_lot_form->lot_id = $lot_id;
        $closing_reasons = ClosingReason::find()->orderBy(['id' => SORT_DESC])->all();

        if (Yii::$app->request->isPost) {
            $close_lot_form->load(Yii::$app->request->post());

            if ($close_lot_form->validate()) {
                $lot = Lot::findOne($close_lot_form->lot_id);

                $lot->closing_reason_id = $close_lot_form->closing_reason_id;
                if ($close_lot_form->closing_reason_id === self::USER_REASON_ID) {
                    $lot->closing_reason = $close_lot_form->closing_reason;
                }

                if ($lot->save()) {
                    return $this->redirect(['lot/view', 'lot_id' => $close_lot_form->lot_id]);
                }
            }
        }

        $lot = Lot::findOne($close_lot_form->lot_id);

        return $this->render('close', [
            'lot' => $lot,
            'closing_reasons' => $closing_reasons,
            'model' => $close_lot_form
        ]);
    }
}
