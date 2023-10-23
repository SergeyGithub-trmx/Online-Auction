<?php

/** @var yii\web\View $this */
/** @var app\models\forms\LoginForm $model */

use app\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

LoginAsset::register($this);

$this->title = Yii::$app->name . ' | Вход';

?>
<section class="login-registration-block">
    <div class="container">

        <?php $form = ActiveForm::begin([
            'action' => Url::to(['user/login']),
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
            <h2 class="text-center">Вход</h2>

            <?= $form->field($model, 'username')->textInput() ?>
            <?= $form->field($model, 'password')->input('password') ?>

            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block create-account']) ?>

            <div id="having-an-account">
                <p>Ещё нет аккаунта?</p>
                <a class="already-have-an-account" href="<?= Url::to(['user/register']) ?>">Создать.</a>
            </div>
        <?php ActiveForm::end(); ?>

    </div>
</section>
