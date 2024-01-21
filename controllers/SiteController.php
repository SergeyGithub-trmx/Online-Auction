<?php

namespace app\controllers;

use app\models\Category;
use app\models\Lot;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;

class SiteController extends BaseController
{
    public $category;
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'category', 'search'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
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

    public function actionCategory(?string $category): string
    {
        $this->category = Category::findOne(['inner_code' => $category]);

        $query = Lot::find()->where(['category_id' => $this->category->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(10);
        $lots = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('category', [
            'lots' => $lots,
            'pages' => $pages,
        ]);
    }

    public function actionSearch(): string
    {
        $req = Yii::$app->request->get('SearchLotForm')['req'] ?? '';
        $this->search_model->req = $req;

        $query = Lot::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(10);

        $lots = $query
            ->where("MATCH (name) AGAINST ('$req*' IN BOOLEAN MODE)")
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        if (empty($lots)) {
            $lots = Lot::find()
                ->where(['LIKE', 'name', "$req"])
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        }

        return $this->render('search', [
            'req' => $req,
            'lots' => $lots,
            'pages' => $pages
        ]);
    }
}
