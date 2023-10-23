<?php

/** @var yii\web\View $this */
/** @var app\models\Lot $lot */
/** @var app\models\User $this->context->user */

use app\assets\LotAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
LotAsset::register($this);

const USER_REASON_ID = 1;

?>
<h1>Ваш лот</h1>
<div class="wrapper">
    <div class="lot">
        <img src="/uploads/<?= Html::encode($lot->image_path) ?>" width="320">
        <h2><i><?= Html::encode($lot->name) ?></i></h2>
        <p class="category"><b>Категория:</b> <?= Html::encode($lot->category->name) ?></p>
        <p class="description"><b>Описание:</b> <?= Html::encode($lot->description) ?></p>
        <p class="starting_price"><b>Начальная цена:</b> <?= Html::encode($lot->starting_price) ?></p>
        <p class="deadline"><b>Срок размещения:</b> <?= Html::encode($lot->deadline) ?></p>
        <p class="status"><b>Статус:</b> <?= is_null($lot->closing_reason_id) ? 'открыт' : 'закрыт' ?></p>

        <?php if (isset($lot->closing_reason_id) && $lot->closing_reason_id !== USER_REASON_ID): ?>
            <p class="closing_reason"><b>Причина закрытия:</b> <?= Html::encode($lot->closing_reason) ?></p>
        <?php endif; ?>

        <p class="author"><b>Автор лота:</b> <a href="#"><?= Html::encode($lot->user->name) ?></a></p>

        <?php if ($lot->user_id === $this->context->user->id && is_null($lot->closing_reason_id)): ?>
            <a href="<?= Url::to(['lot/close', 'lot_id' => $lot->id]) ?>" class="btn btn-danger align-self-end mt-3">Закрыть лот</a>
        <?php endif; ?>

    </div>
</div>