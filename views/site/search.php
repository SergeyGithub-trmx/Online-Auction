<?php

/** @var yii\web\View $this */
/** @var app\models\Lot[] $lots */
/** @var yii\data\Pagination $pages */
/** @var string $req */
/** @var app\models\User $this->context->user */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name . ' | Поиск';
$user = $this->context->user;

?>
<?= Yii::$app->session->getFlash('success'); ?>
<section class="lot-list section-py section-min-height">
    <div class="container">

        <?php if (!empty($lots)): ?>
            <div class="row">
                <div class="col">
                    <h1 class="fs-2">Вот, что нашлось по запросу «<?= Html::encode($req) ?>»</h1>
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
                    <h1 class="fs-2 text-center">
                        К нашему огромному сожалению, <?= Html::encode($user->name) ?>,
                        ничего не нашлось<br>по запросу «<?= Html::encode($req) ?>»...
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
