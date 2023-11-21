<?php

namespace app\controllers;

use app\models\Lot;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    public $user;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        $query = Lot::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(10);
        $lots = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', [
            'lots' => $lots,
            'pages' => $pages
        ]);
    }
}
