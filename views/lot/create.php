<?php

/** @var app\models\Category[] $categories */
/** @var app\models\forms\CreateLotForm $model */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name . ' | Добавить лот';

?>
<section class="lot-adding-section section-py section-min-height">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1 class="fs-2">Добавить лот</h1>
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['lot/create']),
                    'method' => 'post',
                    'enableAjaxValidation' => false,
                    'options' => [
                        'class' => 'p-3 bg-primary-subtle mt-4',
                        'enctype' => 'multipart/form-data',
                        'novalidate' => true,
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

                    <div class="row">
                        <div class="col">
                            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Введите название лота']) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'description')->textArea(['style' => 'min-height: 200px; resize: none;', 'placeholder' => 'Введите описание лота']) ?>
                    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/jpg, image/jpeg, image/png, image/bmp', 'class' => 'form-control']) ?>

                    <div class="row">
                        <div class="col">
                            <?= $form->field($model, 'starting_price')->input('number', ['min' => 10, 'placeholder' => 'Минимальная: 10']) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'bet_step')->input('number', ['min' => 1, 'placeholder' => 'Минимальный: 1']) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'deadline', ['enableAjaxValidation' => true])->input('date') ?>
                        </div>
                    </div>

                    <?= Html::submitInput('Добавить', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
