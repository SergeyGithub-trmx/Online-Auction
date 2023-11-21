<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\Category;
use app\models\Lot;

class CreateLotForm extends Model
{
    public $category_id;
    public $name;
    public $description;
    public $image;
    public $starting_price;
    public $deadline;
    public $bet_step;

    const B_PER_MB = 1024 ** 2;
    const MAX_FILE_SIZE = 25;

    public function rules(): array
    {
        return [
            ['category_id', 'required'],
            ['category_id', 'integer'],
            ['category_id', 'exist', 'targetClass' => Category::class, 'targetAttribute' => 'id'],

            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 4, 'max' => 128],
            ['name', 'unique', 'targetClass' => Lot::class, 'targetAttribute' => 'name'],

            ['description', 'trim'],
            ['description', 'required'],
            ['description', 'string', 'max' => 512],

            ['image', 'required'],
            ['image', 'file', 'extensions' => 'jpg, jpeg, png, bmp', 'maxSize' => self::B_PER_MB * self::MAX_FILE_SIZE],

            ['starting_price', 'required'],
            ['starting_price', 'integer', 'min' => 10],

            ['deadline', 'required'],
            ['deadline', 'string'],
            ['deadline', 'date', 
                'format' => 'php:Y-m-d', 
                'min' => strtotime('tomorrow'), 
                'tooSmall' => 'Запрещено ставить дату раньше, чем завтра.'
            ],

            ['bet_step', 'required'],
            ['bet_step', 'integer', 'min' => 1],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'category_id' => 'Категория',
            'name' => 'Название',
            'description' => 'Описание',
            'image' => 'Изображение',
            'starting_price' => 'Начальная цена',
            'deadline' => 'Срок размещения',
            'bet_step' => 'Шаг ставки'
        ];
    }
}