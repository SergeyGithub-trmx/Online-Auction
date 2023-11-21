<?php

namespace app\services;

use app\models\Bet;
use app\models\forms\CreateBetForm;

class BetService
{
    public function create(CreateBetForm $model): bool
    {
        $bet = new Bet();

        $bet->user_id = $model->user_id;
        $bet->lot_id = $model->lot_id;
        $bet->summary = $model->summary;

        return $bet->save();
    }
}
