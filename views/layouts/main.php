<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\models\User;
use yii\helpers\Html;

$this->registerCsrfMetaTags();
$user = $this->context->user ?? null;
$categories = $this->context->categories;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        
        <?= $this->render('_main-header.php', ['user' => $user]) ?>
        <main><?= $content ?></main>
        <?= $this->render('_main-footer.php', ['categories' => $categories]) ?>
        <script src="https://kit.fontawesome.com/9f99803486.js" crossorigin="anonymous"></script>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
