<?php

namespace app\models\forms;

use app\models\ClosingReason;
use app\models\Lot;
use yii\base\Model;

class CloseLotForm extends Model
{
    public $lot_id;
    public $closing_reason;
    public $closing_reason_id;

    public function rules(): array
    {
        return [
            ['lot_id', 'required'],
            ['lot_id', 'integer'],
            ['lot_id', 'exist', 'targetClass' => Lot::class, 'targetAttribute' => 'id'],

            ['closing_reason', 'trim'],
            ['closing_reason', 'string', 'max' => 256],
            ['closing_reason', 'default', 'value' => null],

            ['closing_reason_id', 'required'],
            ['closing_reason_id', 'integer'],
            ['closing_reason_id', 'exist', 'targetClass' => ClosingReason::class, 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'lot_id' => 'hidden',
            'closing_reason' => 'Опишите свою причину',
            'closing_reason_id' => 'Выберите причину'
        ];
    }
}