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
<?php $form = ActiveForm::begin([
    'action' => Url::to(['lot/close', 'lot_id' => $model->lot_id]),
    'method' => 'post',
    // 'enableAjaxValidation' => true
    'options' => [
        'enctype' => 'application/x-www-form-urlencoded'
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
    <h2 class="text-center">Закрыть лот</h2>

    <?= $form->field($model, 'closing_reason_id')->dropDownList(ArrayHelper::map($closing_reasons, 'id', 'reason')) ?>
    <?= $form->field($model, 'closing_reason', ['options' => ['id' => 'test', 'style' => 'display: none;']])->textArea() ?>

    <?= Html::submitButton('Закрыть лот', ['class' => 'btn btn-primary']) ?>
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
