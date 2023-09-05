<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\modules\catalog\models\root\Product;
use backend\modules\content\models\Question;
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

        <!-- Хиты продаж -->
        <?= $this->render('//layouts/_top_sales', ['title' => "Хиты продаж", 'topSales' => Product::getTopSales()]); ?>

        <?php if (isset($this->blocks['subscribe'])): ?>
            <?= $this->blocks['subscribe'] ?>
        <?php endif ?>
       
        <?php if (isset($this->blocks['pop-categories'])): ?>
            <?= $this->blocks['pop-categories'] ?>
        <?php endif ?>


        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/product/_faq_bottom', ['questions' => Question::getShareQuestions()]); ?>

    </div>
</body>

<?= $this->render('_footer', ['settings' => $settings]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
