<?php

namespace app\services;

use Yii;
use app\models\User;
use app\models\forms\RegisterForm;

class UserService
{
    public function create(RegisterForm $register_form): bool
    {
        $user = new User();
        $user->name = $register_form->username;
        $user->email = $register_form->email;
        $user->password_hash = Yii::$app->security->generatePasswordHash($register_form->password);
        $user->contacts = $register_form->contacts;

        if (isset($register_form->avatar)) {
            $filename = uniqid($register_form->avatar->baseName . '_') . '.' . $register_form->avatar->extension;
            $register_form->avatar->saveAs('uploads/' . $filename);
            $user->avatar_path = $filename;
        }

        return $user->save();
    }
}
