<?php

/** @var yii\web\View $this */
/** @var app\models\User $this->context->user */
/** @var app\models\Bet $bets */
/** @var yii\data\Pagination $pages */

use app\assets\BetAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

BetAsset::register($this);
$this->registerCss('body {background-color: #F0F8FF}');
$this->title = Yii::$app->name . ' | Мои ставки';

$timestamp = time();

?>
<section class="section-py section-min-height">
    <div class="container">
        <div class="row">
            <div class="col">

                <?php if (!empty($bets)): ?>
                    <h1 class="fs-2">Мои ставки</h1>
                    <table class="table table-bordered mt-4">
                        <tbody>

                            <?php foreach ($bets as $bet): ?>
                                <?php
                                $timer = date('d.m.Y', strtotime($bet->lot->deadline));
                                $is_expired = strtotime($bet->lot->deadline) < $timestamp;
                                $timer = $is_expired ? 'Торги окончены' : $timer;
                                $class_name = $is_expired ? 'secondary' : 'primary';
                                ?>
                                <tr>
                                    <td style="width: 500px">
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="/uploads/<?= $bet->lot->image_path ?>"
                                                width="70"
                                                height="70"
                                                alt="<?= $bet->lot->name ?>"
                                                style="border: 1px solid #dbdbdb; object-fit: cover; object-position: center"
                                            >
                                            <a
                                                class="ms-2 fs-5 link-dark"
                                                href="<?= Url::to(['lot/view', 'lot_id' => $bet->lot_id]) ?>"
                                                style="text-decoration: none"
                                            ><?= Html::encode($bet->lot->name) ?></a>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?= Html::encode($bet->lot->category->name) ?></td>
                                    <td class="align-middle">
                                        <span class="badge bg-<?= $class_name ?> fs-6"><?= Html::encode($timer) ?></span>
                                    </td>
                                    <td class="align-middle"><?= number_format($bet->summary, thousands_separator: ' ') ?> руб.</td>
                                    <td class="align-middle"><?= date('d.m.Y в H:i', strtotime($bet->dt_add)) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <h1 class="text-center fs-2">
                        Ставок пока нет. Почему бы не
                        <a class="text-decoration-none link-primary" href="<?= Url::to(['site/index']) ?>">создать</a>
                        парочку новых?
                    </h1>
                <?php endif; ?>

            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <hr>
                <div class="d-flex justify-content-center">
                    <?= LinkPager::widget([
                        'options' => ['class' => 'pagination mt-2 mb-0'],
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
