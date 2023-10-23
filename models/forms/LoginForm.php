<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\User;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules(): array
    {
        return [
            [['username'], 'trim'],
            [['username'], 'required'],
            [['username'], 'string', 'min' => 4, 'max' => 64],

            [['password'], 'trim'],
            [['password'], 'required'],
            [['password'], 'string', 'max' => 64],
            [['password'], 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль'
        ];
    }

    public function validatePassword($attr, $params): void
    {
        if (!$this->hasErrors()) {
            $user = User::findOne(['name' => $this->username]);
            if (!$user || !$user->validatePasswordHash($this->password)) {
                $this->addError($attr, 'Неверный логин или пароль.');
            }
        }
    }
}