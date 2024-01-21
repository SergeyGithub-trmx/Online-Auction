<?php

namespace app\controllers;

use app\models\Category;
use app\models\forms\SearchLotForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public ?User $user;
    public $categories;
    public $search_model;

    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);
        $this->categories = Category::find()->all();
        $this->search_model = new SearchLotForm();

        return true;
    }
}