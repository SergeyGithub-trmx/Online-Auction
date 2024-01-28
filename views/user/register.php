<?php

/** @var yii\web\View $this */
/** @var app\models\forms\RegisterForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name . ' | Регистрация';

?>
<section class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">

                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['user/register']),
                    'method' => 'post',
                    // 'enableAjaxValidation' => true
                    'options' => [
                        'class' => 'p-4 bg-primary-subtle',
                    //  'style' => '',
                    ],
                    'fieldConfig' => [
                        'options' => ['class' => 'mb-3'],
                        'inputOptions' => ['class' => 'form-control'],
                        'labelOptions' => [
                            'class' => 'form-label',
                            'style' => 'font-weight: bold',
                        ],
                        'errorOptions' => [
                            'class' => 'form-text invalid-feedback',
                            'style' => 'display: block; font-style: italic; font-weight: bold;',
                        ],
                        'template' => '{label}{input}{error}'
                    ],
                ]); ?>
                    <h2 class="text-center">Регистрация</h2>

                    <?= $form->field($model, 'username')->textInput() ?>
                    <?= $form->field($model, 'password')->input('password') ?>
                    <?= $form->field($model, 'password_repeat')->input('password') ?>
                    <?= $form->field($model, 'email')->input('email') ?>
                    <?= $form->field($model, 'contacts')->textArea() ?>
                    <?= $form->field($model, 'avatar')->fileInput() ?>

                    <div class="d-grid">
                        <?= Html::submitInput('Вперёд!', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <p>Уже есть аккаунт?</p>
                        <a class="ms-1 text-decoration-none" href="<?= Url::to(['user/login']) ?>">Войти.</a>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>