<?php

namespace app\models\forms;

use yii\base\Model;

class SearchLotForm extends Model
{
    public $req;

    public function rules(): array
    {
        return [
            ['req', 'trim'],
            ['req', 'required'],
            ['req', 'string', 'min' => 3, 'max' => 128],
        ];
    }
}