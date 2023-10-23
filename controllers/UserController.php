<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\User;
use app\services\UserService;

class UserController extends Controller
{
    public $user;

    public function behaviors()
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

    public function actionLogin()
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

    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        return $this->goHome();
    }

    public function actionProfile()
    {
        $this->layout = 'main';
        $this->user = User::findOne(Yii::$app->user->id);

        return $this->render('profile');
    }

    public function actionRegister()
    {
        $this->layout = 'main';
        $register_form = new RegisterForm();
        
        if (Yii::$app->request->isPost) {
            $register_form->load(Yii::$app->request->post());
            $register_form->avatar = UploadedFile::getInstance($register_form, 'avatar');
    
            if ($register_form->validate()) {
                if ((new UserService())->create($register_form)) {
                    return $this->redirect(['user/login']);
                }
            }
        }
    
        return $this->render('register', [
            'model' => $register_form,
        ]);
    }
}
