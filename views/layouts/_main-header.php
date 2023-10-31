<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header>
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: rgb(0, 4, 54);" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><?= Yii::$app->name ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php if (!Yii::$app->user->isGuest): ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['lot/create']) ?>">Добавить лот</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['user/profile']) ?>"><?= Html::encode($user->name) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Url::to(['user/logout']) ?>">Выход</a>
                        </li>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </nav>
</header>
