<?php

/** @var yii\web\View $this */
/** @var app\models\User $this->context->user */

use app\assets\BetAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerCss('body {background-color: #F0F8FF}');
BetAsset::register($this);

?>

<section style="margin-top: 95px;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Мои ставки</h1>
                <table class="table table-bordered mt-4">
                    <tbody>

                        <?php foreach ($this->context->user->bets as $bet): ?>
                            <tr>
                                <td style="width: 500px">
                                    <div class="d-flex align-items-center">
                                        <img
                                            src="/uploads/<?= $bet->lot->image_path ?>"
                                            width="70"
                                            height="70"
                                            alt="<?= $bet->lot->name ?>"
                                            style="object-fit: cover; object-position: center"
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
                                    <span class="badge bg-primary fs-6"><?= date('d.m.Y', strtotime($bet->lot->deadline)) ?></span>
                                </td>
                                <td class="align-middle"><?= number_format($bet->summary, thousands_separator: ' ') ?> руб.</td>
                                <td class="align-middle"><?= date('d.m.Y в H:i', strtotime($bet->dt_add)) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
