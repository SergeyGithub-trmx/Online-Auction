<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\symfonymailer\Logger;

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

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getLot(): ActiveQuery
    {
        return $this->hasOne(Lot::class, ['id' => 'lot_id']);
    }

}
