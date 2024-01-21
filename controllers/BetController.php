<?php

namespace app\controllers;

use app\models\Bet;
use app\models\Lot;
use yii\data\Pagination;
use yii\filters\AccessControl;

class BetController extends BaseController
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list', 'define-winner'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionList(): string
    {
        $query = Bet::find()->where(['user_id' => $this->user->id]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(7);
        $bets = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('my-bets', [
            'bets' => $bets,
            'pages' => $pages,
        ]);
    }

    public function actionDefineWinner(): void
    {
        $timestamp = time();
        $lots = Lot::find()->where(['is', 'winner_bet_id', null])->all();
        foreach ($lots as $lot) {
            if (!empty($lot->bets) && strtotime($lot->deadline) < $timestamp) {
                $bets = $lot->bets;
                uasort($bets, function ($a, $b) {
                    return $a->amount < $b->amount ? 1 : -1;
                });
                $lot->winner_bet_id = current($bets)->id;
                $lot->save();
            }
        }
    }
}