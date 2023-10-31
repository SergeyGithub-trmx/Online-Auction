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
<?php $form = ActiveForm::begin([
    'action' => Url::to(['lot/create']),
    'method' => 'post',
    // 'enableAjaxValidation' => true
    'options' => [
        'enctype' => 'multipart/form-data'
        // 'class' => 'value1'
    ]
    // 'fieldConfig' => [
    //     'options' => ['class' => 'value0'],
    //     'inputOptions' => ['class' => 'another_value'],
    //     'labelOptions' => ['class' => 'fgsdfvsvdftdsfy'],
    //     'errorOptions' => ['class' => 'value_for_errors'],
    //     'template' => '{label}{input}{error}'
    // ],
]); ?>
    <h2 class="text-center">Добавить лот</h2>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
    <?= $form->field($model, 'description')->textArea(['style' => 'resize: vertical;']) ?>
    <?= $form->field($model, 'image')->input('file', ['accept' => 'image/jpg, image/jpeg, image/png, image/bmp']) ?>
    <?= $form->field($model, 'starting_price')->input('number', ['min' => '10']) ?>
    <?= $form->field($model, 'deadline')->input('date') ?>
    <?= $form->field($model, 'bet_step')->input('number', ['min' => '50']) ?>

    <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary btn-block create-account']) ?>
<?php ActiveForm::end(); ?>
