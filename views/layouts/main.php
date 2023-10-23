<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\models\User;
use yii\helpers\Html;

$this->registerCsrfMetaTags();
$user = $this->context->user ?? null;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        
        <?= $this->render('_main-header.php', ['user' => $user]) ?>
        <main><?= $content ?></main>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
