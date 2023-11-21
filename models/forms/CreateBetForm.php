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
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'summary' => 'Cтавка',
        ];
    }
}