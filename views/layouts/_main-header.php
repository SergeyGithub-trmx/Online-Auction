<?php

/** @var yii\web\View $this */
/** @var app\models\User $user */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="main-header">
    <div class="container">
        <nav>
            <a class="logo" href="<?= Url::home() ?>">Онлайн аукцион</a>

            <?php if (!Yii::$app->user->isGuest): ?>
                <ul class="user-menu">
                    <li>
                        <a class="username" href="<?= Url::to(['lot/create']) ?>">Добавить лот</a>
                    </li>

                    <li>
                        <a class="username" href="<?= Url::to(['user/profile']) ?>"><?= Html::encode($user->name) ?></a>
                    </li>
                    
                    <li>
                        <a class="logout-btn" href="<?= Url::to(['user/logout']) ?>">Выход</a>
                    </li>   
                </ul>
            <?php endif; ?>

        </nav>            
    </div>      
</header>
