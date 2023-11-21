<?php

/** @var app\models\Category[] $categories */

use app\assets\CreateLotAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Добавить лот | Онлайн-аукцион';
CreateLotAsset::register($this);

?>
<section class="lot-adding-section" style="margin-top: 100px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['lot/create']),
                    'method' => 'post',
                    'enableAjaxValidation' => false,
                    'options' => [
                        'class' => 'p-3 d-flex',
                        'enctype' => 'multipart/form-data',
                        'novalidate' => true,
                        'style' => '
                            flex-direction: column;
                            background-color: #cfdaff;
                            border-radius: 15px;
                            box-shadow: #00000080 0 0 10px 0;
                        ',
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
                    <h2 class="text-center">Добавить лот</h2>

                    <?= $form->field($model, 'name')->textInput() ?>
                    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
                    <?= $form->field($model, 'description')->textArea(['style' => 'resize: vertical;']) ?>
                    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/jpg, image/jpeg, image/png, image/bmp', 'class' => 'form-control']) ?>
                    <?= $form->field($model, 'starting_price')->input('number', ['min' => 10]) ?>
                    <?= $form->field($model, 'deadline', ['enableAjaxValidation' => true])->input('date') ?>
                    <?= $form->field($model, 'bet_step')->input('number', ['min' => 1]) ?>

                    <?= Html::submitInput('Добавить', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
