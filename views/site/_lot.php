<?php

/** @var yii\web\View $this */
/** @var app\models\Lot $lot */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="card">
    <img
        class="card-img-top"
        src="./uploads/<?= Html::encode($lot->image_path) ?>"
        height="150"
        alt="<?= Html::encode($lot->name) ?>"
        style="object-fit: cover; object-position: center;"
    >
    <div class="card-body">
        <h5 class="card-title">
            <a
                class="link-dark text-decoration-none fs-italic"
                href="<?= Url::to(['lot/view', 'lot_id' => $lot->id]) ?>"
            ><?= Html::encode($lot->name) ?></a>
        </h5>
        <p class="card-text m-0 mt-3">Стартовая цена: <?= Html::encode($lot->starting_price) ?> руб.</p>
        <p class="card-text m-0" style="min-height: 50px;">Категория: <?= Html::encode($lot->category->name) ?></p>
    </div>
    <div class="card-footer text-body-secondary"> <?= date('d.m.Y', strtotime($lot->deadline)) ?></div>
</div>