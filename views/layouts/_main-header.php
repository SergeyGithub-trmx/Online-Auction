<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

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

                        <?php $form = ActiveForm::begin([
                            'action' => Url::to(['site/search']),
                            'method' => 'get',
                            'enableAjaxValidation' => false,
                            'options' => [
                                'class' => 'd-flex',
                            ],
                            'fieldConfig' => [
                                'inputOptions' => ['class' => 'form-control me-2 bg-primary-subtle'],
                                'template' => '{input}'
                            ],
                        ]); ?>

                        <?= $form
                            ->field($this->context->search_model, 'req')
                            ->input('search', ['value' => $this->context->search_model->req, 'placeholder' => 'Поиск на сайте', 'style' => 'width: 300px;']) ?>

                        <?php ActiveForm::end(); ?>

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
                                <li><a class="dropdown-item" href="<?= Url::to(['/my-bets']) ?>">Мои ставки</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= Url::to(['user/logout']) ?>">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a
                                class="nav-link<?= parse_url(Url::canonical())['path'] === '/login' ? ' active' : '' ?>"
                                href="<?= Url::to(['user/login']) ?>"
                            >Вход</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link<?= parse_url(Url::canonical())['path'] === '/register' ? ' active' : '' ?>"
                                href="<?= Url::to(['user/register']) ?>"
                            >Регистрация</a>
                        </li>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </nav>
</header>
