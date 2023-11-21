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
<section class="lot-list" style="margin-top: 95px;">
    <div class="container">

        <div class="row">
            <div class="col">
                <?php if (count($lots) === 0): ?>
                    <h1 class="text-center">Лотов пока нет. Почему бы не создать парочку новых?</h1>
                <?php else: ?>
                    <h1 class="text-center">Здесь ваши лоты</h1>
                <?php endif; ?>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-5 g-4 mt-1">

            <?php foreach ($lots as $lot): ?>
                <div class="col"> 
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
                                <a class="link-dark" href="<?= Url::to(['lot/view', 'lot_id' => $lot->id]) ?>"><?= Html::encode($lot->name) ?></a>
                            </h5>
                            <p class="card-text mb-0">Категория: <?= Html::encode($lot->category->name) ?></p>
                            <p class="card-text">Стартовая цена: <?= Html::encode($lot->starting_price) ?> руб.</p>
                        </div>
                        <div class="card-footer text-body-secondary"> <?= Html::encode($lot->deadline) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="row mt-2">
            <div class="col">
                <hr>
                <div class="d-flex justify-content-center">
                    <?= LinkPager::widget([
                        'options' => ['class' => 'pagination mt-2'],
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
            </div>
        </div>
    </div>
</section>
