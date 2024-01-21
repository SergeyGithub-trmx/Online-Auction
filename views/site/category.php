<?php

/** @var yii\web\View $this */
/** @var app\models\Lot[] $lots */
/** @var yii\data\Pagination $pages */
/** @var string $category */

use app\assets\IndexAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

IndexAsset::register($this);
$category = $this->context->category;
$this->title = Yii::$app->name . ' | ' . Html::encode($category->name);

?>
<?= Yii::$app->session->getFlash('success'); ?>
<section class="lot-list section-py section-min-height">
    <div class="container">

        <?php if (!empty($lots)): ?>
            <div class="row">
                <div class="col">
                    <h1 class="fs-2">Здесь собраны все лоты из категории «<?= Html::encode($category->name) ?>»</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-5 g-4 mt-0">

                <?php foreach ($lots as $lot): ?>
                    <div class="col">
                        <?= $this->render('_lot', ['lot' => $lot]) ?>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <div class="row">
                <div class="col">
                    <h1 class="text-center fs-2">
                        Лотов пока нет. Почему бы не
                        <a class="text-decoration-none link-primary" href="<?= Url::to(['lot/create']) ?>">создать</a>
                        парочку новых?
                    </h1>
                </div>
            </div>
        <?php endif; ?>

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
