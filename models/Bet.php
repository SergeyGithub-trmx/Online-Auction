<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $lot_id
 * @property string $dt_add
 * @property int $summary
 */
class Bet extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%bet}}';
    }
}
