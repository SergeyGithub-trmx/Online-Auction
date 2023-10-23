<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $dt_add
 * @property string $reason
 */
class ClosingReason extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%closing_reason}}';
    }
}
