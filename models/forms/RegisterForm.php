<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    public $email;
    public $contacts;
    public $avatar;

    public function rules(): array
    {
        return [
            [['username'], 'trim'],
            [['username'], 'required'],
            [['username'], 'string', 'min' => 4, 'max' => 64],
            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'name'],

            [['password'], 'trim'],
            [['password'], 'required'],
            [['password'], 'string', 'max' => 64],

            [['password_repeat'], 'trim'],
            [['password_repeat'], 'required'],
            [['password_repeat'], 'string', 'max' => 64],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password'],

            [['email'], 'trim'],
            [['email'], 'required'],
            [['email'], 'string', 'max' => 64],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email'],

            [['contacts'], 'trim'],
            [['contacts'], 'string', 'max' => 512],
            [['contacts'], 'default', 'value' => null],

            [['avatar'], 'file', 'extensions' => 'jpg, jpeg, png, bmp']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'email' => 'Электронная почта',
            'contacts' => 'Контактная информация',
            'avatar' => 'Фото профиля'
        ];
    }
}
