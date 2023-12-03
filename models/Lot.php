<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $dt_add
 * @property string $name
 * @property string $description
 * @property string $image_path
 * @property int $starting_price
 * @property string $deadline
 * @property int $bet_step
 * @property string $closing_reason
 * @property int $closing_reason_id
 *
 * @property Bet[] $bets
 * @property Category $category
 * @property User $user
 */
class Lot extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%lot}}';
    }

    public function rules(): array
    {
        return [
            ['category_id', 'required'],
            ['category_id', 'integer'],
            ['category_id', 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id'],

            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],

            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 4, 'max' => 128],

            ['description', 'trim'],
            ['description', 'required'],
            ['description', 'string', 'max' => 512],

            ['image_path', 'required'],
            ['image_path', 'file', 'extensions' => 'jpg, jpeg, png, bmp'],

            ['starting_price', 'required'],
            ['starting_price', 'integer', 'min' => 10],

            ['deadline', 'required'],
            ['deadline', 'string'],

            ['bet_step', 'required'],
            ['bet_step', 'integer', 'min' => 1],

            ['closing_reason', 'trim'],
            ['closing_reason', 'string'],
            ['closing_reason', 'default', 'value' => null],

            ['closing_reason_id', 'integer'],
            ['closing_reason_id', 'exist', 'targetClass' => ClosingReason::class, 'targetAttribute' => 'id'],
        ];
    }

    public function getBets(): ActiveQuery
    {
        return $this->hasMany(Bet::class, ['lot_id' => 'id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
