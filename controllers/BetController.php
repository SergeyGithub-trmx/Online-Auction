<?php

namespace app\controllers;

use app\models\Lot;
use app\models\User;
use Yii;
use yii\web\Controller;

class BetController extends Controller
{
    public $user;

    public function actionList(): string
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        return $this->render('my-bets', []);
    }

    public function actionDefineWinner(): void
    {
        $lots = Lot::find()->where(['is', 'winner_bet_id', null])->all();
        foreach ($lots as $lot) {
            print('Hz');
        }
    }
}