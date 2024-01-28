<?php

namespace app\controllers;

use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\User;
use app\services\UserService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

class UserController extends BaseController
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'register'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'profile'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionLogin(): Response|string
    {
        $this->layout = 'main';
        $login_form = new LoginForm();
        
        if (Yii::$app->request->isPost) {
            $login_form->load(Yii::$app->request->post());

            if ($login_form->validate()) {
                $user = User::findOne(['name' => $login_form->username]);
                Yii::$app->user->login($user);
                
                return $this->goHome();
            }
        }
        
        return $this->render('login', [
            'model' => $login_form
        ]);
    }

    public function actionLogout(): Response|string
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionProfile(): string
    {
        return $this->render('profile');
    }

    public function actionRegister(): Response|string
    {
        $model = new RegisterForm();
        
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
    
            if ($model->validate()) {
                if ((new UserService())->create($model)) {
                    return $this->redirect(['user/login']);
                }
            }
        }
    
        return $this->render('register', [
            'model' => $model,
        ]);
    }
}
