<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Menu;

$is_guest = Yii::$app->user->isGuest;

?>
<header>
    <nav class="navbar fixed-top navbar-expand-lg py-3" style="background-color: rgb(0, 4, 54);" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="<?= Url::to(['site/index']) ?>"><?= Yii::$app->name ?></a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php if (!$is_guest): ?>
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
                                ->input('search', [
                                    'value' => $this->context->search_model->req,
                                    'placeholder' => 'Поиск на сайте', 'style' => 'width: 300px;'
                            ]) ?>

                        <?php ActiveForm::end(); ?>

                    </search>
                    <a class="btn btn-outline-primary btn-sm ms-4" href="<?= Url::to(['lot/create']) ?>">Добавить лот</a>
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-4">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            ><?= Html::encode($user->name) ?></a>

                            <?= Menu::widget([
                                'items' => [
                                    ['label' => 'Мой профиль', 'url' => ['user/profile'], 'visible' => !$is_guest],
                                    ['label' => 'Мои ставки', 'url' => ['bet/list'], 'visible' => !$is_guest],
                                    ['template' => '<hr class="dropdown-divider">'],
                                    ['label' => 'Выход', 'url' => ['user/logout'], 'visible' => !$is_guest],
                                ],
                                'options' => ['class' => 'dropdown-menu dropdown-menu-end mt-2'],
                                'linkTemplate' => '<a class="dropdown-item" href="{url}">{label}</a>',
                                'activeCssClass' => 'active'
                            ]) ?>
                        </li>
                    </ul>
                <?php else: ?>
                    <?= Menu::widget([
                        'items' => [
                            ['label' => 'Вход', 'url' => ['user/login'], 'visible' => $is_guest],
                            ['label' => 'Регистрация', 'url' => ['user/register'], 'visible' => $is_guest]
                        ],
                        'options' => ['class' => 'navbar-nav mb-2 mb-lg-0 ms-auto'],
                        'itemOptions' => ['class' => 'nav-item'],
                        'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
                        'activeCssClass' => 'active'
                    ]) ?>
                <?php endif; ?>

            </div>
        </div>
    </nav>
</header>
