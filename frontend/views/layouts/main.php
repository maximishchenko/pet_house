<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
$settings = Yii::$app->get('configManager');

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="page">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#111111">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<body class="page__body">
    <div class="site-container">
        <?= $this->render('_header', ['settings' => $settings]); ?>
        <main class="main">

            <?= $this->render('_breadcrumbs'); ?>
            <?= $content ?>
    
        </main>

        <?php if (isset($this->blocks['subscribe'])): ?>
            <?= $this->blocks['subscribe'] ?>
        <?php endif ?>
        <?php if (isset($this->blocks['faq_bottom'])): ?>
            <?= $this->blocks['faq_bottom'] ?>
        <?php endif ?>

    </div>
</body>

<?= $this->render('_footer', ['settings' => $settings]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
