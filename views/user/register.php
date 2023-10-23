<?php

/** @var yii\web\View $this */
/** @var app\models\forms\RegisterForm $model */

use app\assets\RegisterAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

RegisterAsset::register($this);

$this->title = Yii::$app->name . ' | Регистрация';

?>
<section class="login-registration-block">
    <div class="container">

        <?php $form = ActiveForm::begin([
            'action' => Url::to(['user/register']),
            'method' => 'post',
            // 'enableAjaxValidation' => true
            // 'options' => [
            //     'class' => 'value1'
            // ]
            // 'fieldConfig' => [
            //     'options' => ['class' => 'value0'],
            //     'inputOptions' => ['class' => 'another_value'],
            //     'labelOptions' => ['class' => 'fgsdfvsvdftdsfy'],
            //     'errorOptions' => ['class' => 'value_for_errors'],
            //     'template' => '{label}{input}{error}'
            // ],
        ]); ?>
            <h2 class="text-center">Регистрация</h2>

            <?= $form->field($model, 'username')->textInput() ?>
            <?= $form->field($model, 'password')->input('password') ?>
            <?= $form->field($model, 'password_repeat')->input('password') ?>
            <?= $form->field($model, 'email')->input('email') ?>
            <?= $form->field($model, 'contacts')->textArea() ?>
            <?= $form->field($model, 'avatar')->fileInput() ?>

            <?= Html::submitButton('Вперёд!', ['class' => 'btn btn-primary btn-block create-account']) ?>

            <div id="having-an-account">
                <p>Уже есть аккаунт?</p>
                <a class="already-have-an-account" href="<?= Url::to(['user/login']) ?>">Войти.</a>
            </div>
        <?php ActiveForm::end(); ?>

    </div>    
</section>