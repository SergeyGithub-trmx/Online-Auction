<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\helpers\Html;

$this->registerCsrfMetaTags();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                margin: 0;
                background-color: #F0F8FF;
                font-family: Russia;
            }

            h1 {
                font-size: 64px;
            }
            p {
                font-size: 24px;
            }
        </style>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
