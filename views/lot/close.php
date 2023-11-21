<?php

/** @var app\models\Lot $lot */
/** @var app\models\ClosingReason[] $closing_reasons */

use app\assets\CloseLotAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Закрыть лот | Онлайн-аукцион';
CloseLotAsset::register($this);

?>
<section class="lot-closing-section" style="display: flex; align-items: center; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['lot/close', 'lot_id' => $model->lot_id]),
                    'method' => 'post',
                    'enableAjaxValidation' => false,
                    'options' => [
                        'class' => 'p-4 d-flex',
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
                    <h2 class="text-center">Закрыть лот</h2>

                    <?= $form->field($model, 'closing_reason_id')->dropDownList(ArrayHelper::map($closing_reasons, 'id', 'reason')) ?>
                    <?= $form->field($model, 'closing_reason', ['options' => ['id' => 'test', 'style' => 'display: none;']])->textArea() ?>

                    <?= Html::submitInput('Закрыть лот', ['class' => 'btn btn-danger']) ?>
                <?php ActiveForm::end(); ?>

                <script>
                    const USER_REASON_ID = 1;
                    const selectElement = document.querySelector('select');
                    const textAreaElement = document.querySelector('#test');

                    selectElement.addEventListener('change', function (evt) {
                        const reasonId = +evt.target.value;
                        textAreaElement.style.display = reasonId === USER_REASON_ID ? 'block' : 'none';
                    });
                </script>
