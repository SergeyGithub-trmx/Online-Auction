<?php

/** @var yii\web\View $this */
/** @var app\models\Category[] $categories */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<footer class="py-5" style="background-color: #000436;">
    <div class="container">

        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="row mb-4">
                <div class="col">
                    <div class="d-grid gap-2">
                        <div class="btn-group">

                            <?php foreach ($categories as $category): ?>
                                <a
                                    href="<?= Url::to(['site/category', 'category' => $category->inner_code]) ?>"
                                    class="btn btn-outline-primary<?= ($this->context->category->inner_code ?? null) === $category->inner_code ? ' active' : '' ?>"
                                ><?= Html::encode($category->name) ?></a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col d-flex justify-content-between align-items-center">
                <p class="copyright text-light m-0">&copy; <?= date('Y') ?>, <?= Yii::$app->name ?></p>
                <ul class="d-flex m-0 p-0" style="list-style: none; font-size: 25px;">
                    <li>
                        <a class="link-light" href="#"><i class="fa-brands fa-vk"></i></a>
                    </li>
                    <li class="ms-3">
                        <a class="link-light" href="#"><i class="fa-brands fa-discord"></i></a>
                    </li>
                    <li class="ms-3">
                        <a class="link-light" href="#"><i class="fa-brands fa-github"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>