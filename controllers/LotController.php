<?php

namespace app\controllers;

use app\models\Category;
use app\models\ClosingReason;
use app\models\Lot;
use app\models\User;
use app\models\forms\CreateBetForm;
use app\models\forms\CloseLotForm;
use app\models\forms\CreateLotForm;
use app\services\BetService;
use app\services\LotService;
use Yii;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class LotController extends Controller
{
    public User $user;
    const USER_REASON_ID = 1;

    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        return true;
    }

    public function behaviors(): array
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
                        'matchCallback' => function () {
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

    public function actionCreate(): Response|array|string
    {
        $categories = Category::find()->all();
        $model = new CreateLotForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->image = UploadedFile::getInstance($model, 'image');

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }

            if ($model->validate() && (new LotService())->create($model)) {
                Yii::$app->session->setFlash('success', 'Лот создан!');
                return $this->redirect(['site/index']);
            }
        }

        return $this->render('create', [
            'categories' => $categories,
            'model' => $model
        ]);
    }

    public function actionView(int $lot_id): Response|string
    {
        if (!$lot = Lot::findOne($lot_id)) {
            throw new NotFoundHttpException();
        }

        $model = new CreateBetForm();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->user_id = $this->user->id;
            $model->lot_id = $lot_id;

            if ($model->validate()) {
                (new BetService())->create($model);
                return $this->redirect(['lot/view', 'lot_id' => $lot_id]);
            }
        }
        
        return $this->render('view', [
            'lot' => $lot,
            'model' => $model,
        ]);
    }

    public function actionClose(int $lot_id): Response|string
    {
        $model = new CloseLotForm();
        $model->lot_id = $lot_id;
        $closing_reasons = ClosingReason::find()->orderBy(['id' => SORT_DESC])->all();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $lot = Lot::findOne($model->lot_id);

                $lot->closing_reason_id = $model->closing_reason_id;
                if ($model->closing_reason_id === self::USER_REASON_ID) {
                    $lot->closing_reason = $model->closing_reason;
                }

                if ($lot->save()) {
                    return $this->redirect(['lot/view', 'lot_id' => $model->lot_id]);
                }
            }
        }

        $lot = Lot::findOne($model->lot_id);

        return $this->render('close', [
            'lot' => $lot,
            'closing_reasons' => $closing_reasons,
            'model' => $model
        ]);
    }
}
