<?php

/** @var yii\web\View $this */
/** @var app\models\Lot $lot */
/** @var app\models\User $this->context->user */
/** @var app\models\forms\CreateBetForm $model */
/** @var string $current_price */
/** @var string $min_summary */
/** @var string $max_summary */

use app\assets\LotAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

LotAsset::register($this);
$this->title = Yii::$app->name . ' | ' . Html::encode($lot->name);

?>
<section class="lot-view section-py section-min-height">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fs-2"><?= Html::encode($lot->name) ?></h1>
            </div>
        </div>
        <div class="row mt-4">
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
                        <p class="card-text">
                            Стартовая цена: <?= number_format(Html::encode($lot->starting_price), thousands_separator: ' ') ?> руб.
                        </p>
                        <p class="card-text">
                            Автор:
                            <a
                                href="<?= Url::to(['user/profile', 'id' => $lot->user_id]) ?>"
                            ><?= Html::encode($lot->user->name) ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header text-body-secondary"> <?= Html::encode($lot->deadline) ?></div>
                    <div class="card-body">
                        <p class="card-text">
                            Текущая цена:<br>
                            <span class="fs-3 fw-bold"><?= $current_price ?> руб.</span><br>
                            <span class="d-block mt-2 fs-6">Мин. ставка: <?= Html::encode($min_summary) ?> руб.</span>
                            <span class="d-block fs-6">Макс. ставка: <?= Html::encode($max_summary) ?> руб.</span>
                        </p>

                        <?php if ($lot->user_id !== Yii::$app->user->id): ?>
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

                                <?= $form->field($model, 'summary')->input('number', ['placeholder' => 'Здесь будет число']) ?>
                                <?= Html::submitInput('Сделать', ['class' => 'btn btn-primary']) ?>

                            <?php ActiveForm::end(); ?>
                        <?php endif; ?>

                    </div>
                </div>
                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Пользователь</th>
                            <th scope="col">Ставка, руб.</th>
                            <th scope="col">Время ставки</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($lot->bets as $bet): ?>
                            <tr>
                                <td><?= $bet->user->name ?></td>
                                <td><?= number_format($bet->summary, thousands_separator: ' ') ?></td>
                                <td><?= date('m.d.Y в H:i', strtotime($bet->dt_add)) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
