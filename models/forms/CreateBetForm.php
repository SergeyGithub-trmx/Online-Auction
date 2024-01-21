<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\User;
use app\models\Lot;

class CreateBetForm extends Model
{
    public $user_id;
    public $lot_id;
    public $summary;

    const ACCEPTABLE_BET_RANGE = 5000;

    public function rules(): array
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],

            ['lot_id', 'required'],
            ['lot_id', 'integer'],
            ['lot_id', 'exist', 'targetClass' => Lot::class, 'targetAttribute' => 'id'],

            ['summary', 'required'],
            ['summary', 'integer', 'min' => 1],
            ['summary', 'isNotOwner'],
            ['summary', 'validateSummary'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'summary' => 'Cтавка',
        ];
    }

    public function isNotOwner($attr, $params): void
    {
        if (!$this->hasErrors()) {
            $lot = Lot::findOne($this->lot_id);

            if ($this->user_id === $lot->user_id) {
                $this->addError($attr, 'Нельзя сделать ставку на свой лот.');
            }
        }
    }

    public function validateSummary($attr, $params): void
    {
        if (!$this->hasErrors()) {
            $lot = Lot::findOne($this->lot_id);
            $current_price = $min_summary = $lot->starting_price;

            if (count($lot->bets)) {
                $current_price = max(array_column($lot->bets, 'summary'));
                $min_summary = $current_price + $lot->bet_step;
            }

            if ($this->summary < $min_summary) {
                $this->addError($attr, 'Нельзя сделать ставку ниже минимальной.');
            } elseif ($this->summary > ($min_summary + self::ACCEPTABLE_BET_RANGE)) {
                $this->addError($attr, 'Нельзя сделать ставку выше максимальной.');
            }
        }
    }
}