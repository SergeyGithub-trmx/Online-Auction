<?php

/** @var yii\web\View $this */
/** @var app\models\Lot[] $lots */
/** @var yii\data\Pagination $pages */

use app\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name . ' | Главная';
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
IndexAsset::register($this);

?>
<?= Yii::$app->session->getFlash('success'); ?>
<section class="lot-list">
    <div class="container">
        <h1>Здесь ваши лоты</h1>
        <ul class="lots">

            <?php foreach ($lots as $lot): ?>
                <li class="lot_info">
                    <a href="<?= Url::to(['lot/view', 'lot_id' => $lot->id]) ?>">        
                        <h3><span style="font-style: italic;"><?= Html::encode($lot->name) ?></span></h3>
                        <img src="./uploads/<?= Html::encode($lot->image_path) ?>" height="150">
                        <p><span>Категория:</span> <?= Html::encode($lot->category->name) ?></p>
                        <p><span>Начальная цена:</span> <?= Html::encode($lot->starting_price) ?></p>
                        <p><span>Срок размещения:</span> <?= Html::encode($lot->deadline) ?></p>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
        
        <?= LinkPager::widget([
            'options' => ['class' => 'pagination mt-4'],
            // 'disabledPageCssClass' => 'page-item',
            'pagination' => $pages,
            'pageCssClass' => 'page-item',
            'prevPageLabel' => 'Назад',
            'nextPageLabel' => 'Вперёд',
            'prevPageCssClass' => 'page-item',
            'nextPageCssClass' => 'page-item',
            'disabledListItemSubTagOptions' => [
                'class' => 'page-link'
            ],
            'linkOptions' => [
                'class' => 'page-link',
            ],
        ]) ?>

    </div>
</section>
