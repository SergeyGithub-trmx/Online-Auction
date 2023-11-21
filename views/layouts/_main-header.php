<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header>
    <nav class="navbar fixed-top navbar-expand-lg py-3" style="background-color: rgb(0, 4, 54);" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><?= Yii::$app->name ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php if (!Yii::$app->user->isGuest): ?>
                    <search class="ms-auto">
                        <form class="d-flex" role="search">
                            <input
                                class="form-control me-2 bg-primary-subtle"
                                type="search"
                                placeholder="Поиск на сайте"
                                aria-label="Search"
                                style="width: 300px;"
                            >
                        </form>
                    </search>
                    <a class="btn btn-outline-primary ms-4" href="<?= Url::to(['lot/create']) ?>">Добавить лот</a>
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-4">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            ><?= Html::encode($user->name) ?></a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= Url::to(['user/profile']) ?>">Мой профиль</a></li>
                                <li><a class="dropdown-item" href="#">Мои ставки</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= Url::to(['user/logout']) ?>">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </nav>
</header>
