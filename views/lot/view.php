<?php

/** @var yii\web\View $this */
/** @var app\models\Lot $lot */
/** @var app\models\User $this->context->user */
/** @var app\models\forms\CreateBetForm $model */

use app\assets\LotAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
LotAsset::register($this);

const USER_REASON_ID = 1;

?>
<section class="lot-view" style="margin-top: 95px">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1><?= Html::encode($lot->name) ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <img
                        class="card-img-top"
                        src="/uploads/<?= Html::encode($lot->image_path) ?>"
                        height="500"
                        alt="<?= Html::encode($lot->name) ?>"
                        style="object-fit: contain; object-position: center;"
                    >
                    <div class="card-body">
                        <p class="card-text mb-0">Категория: <?= Html::encode($lot->category->name) ?></p>
                        <p class="card-text">Стартовая цена: <?= Html::encode($lot->starting_price) ?> руб.</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-body-secondary"> <?= Html::encode($lot->deadline) ?></div>
                    <div class="card-body">
                        <p class="card-text">Текущая цена:<br><span class="fs-3 fw-bold"><?= number_format($lot->starting_price, thousands_separator: ' ') ?> руб.</span></p>

                        <?php $form = ActiveForm::begin([
                            'action' => Url::to(['lot/view', 'lot_id' => $lot->id]),
                            'method' => 'post',
                            // 'enableAjaxValidation' => true
                            // 'options' => [],
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

                            <?= $form->field($model, 'summary')->input('number', ['placeholder' => 'Мин. ставка: 0']) ?>
                            <?= Html::submitInput('Сделать', ['class' => 'btn btn-primary']) ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
