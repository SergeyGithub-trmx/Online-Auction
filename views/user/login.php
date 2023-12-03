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
<section class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">

                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['user/login']),
                    'method' => 'post',
                    // 'enableAjaxValidation' => true
                    'options' => [
                        'class' => 'p-4',
                        'style' => 'background-color: #cfdaff; border-radius: 15px; box-shadow: #00000080 0 0 10px 0;',
                    ],
                    'fieldConfig' => [
                        'options' => ['class' => 'mb-3'],
                        'inputOptions' => ['class' => 'form-control'],
                        'labelOptions' => [
                            'class' => 'form-label',
                            'style' => 'font-weight: bold;'
                        ],
                        'errorOptions' => [
                            'class' => 'form-text invalid-feedback',
                            'style' => 'display: block; font-style: italic; font-weight: bold;',
                        ],
                        'template' => '{label}{input}{error}' 
                    ],
                ]); ?>
                    <h2 class="text-center">Вход</h2>

                    <?= $form->field($model, 'username')->textInput() ?>
                    <?= $form->field($model, 'password')->input('password') ?>

                    <div class="d-grid">
                        <?= Html::submitInput('Войти', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <p>Ещё нет аккаунта?</p>
                        <a class="ms-1" href="<?= Url::to(['user/register']) ?>">Создать.</a>
                    </div>
                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
