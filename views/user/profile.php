<?php

/** @var yii\web\View $this */

use app\assets\ProfileAsset;

ProfileAsset::register($this);

?>
<div class="user-card">
    <div class="main-info">
        <p>Пользователь сайта</p>
        <div class="avatar"></div>
    </div>
    <div class="profile-history">
        <p>История профиля</p>
        <hr>

        <p>Зарегистрирован: [registration time]</p>
        <hr>

        <p>Последняя активность: [last seen time]</p>
        <hr>

        <p>Страна: [country here]</p>
        <hr>

        <p>Город: [town/city here]</p>
        <hr>

        <p>Рейтинг пользователя: [user rating here]</p>
        <hr>
    </div>
</div>
