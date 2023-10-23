<?php

namespace app\services;

use app\models\Lot;
use app\models\forms\CreateLotForm;
use Yii;

class LotService
{
    public function create(CreateLotForm $model): bool
    {
        $lot = new Lot();

        $lot->category_id = $model->category_id;
        $lot->name = $model->name;
        $lot->description = $model->description;
        $lot->starting_price = $model->starting_price;
        $lot->deadline = $model->deadline;
        $lot->bet_step = $model->bet_step;
        $lot->user_id = Yii::$app->user->id;
        $lot->closing_reason_id = null;
        $lot->closing_reason = null;

        $file_name = uniqid($model->image->baseName . '_') . $model->image->extension;
        $lot->image_path = $file_name;
        $model->image->saveAs('uploads/' . $file_name);

        return $lot->save();
    }
}
