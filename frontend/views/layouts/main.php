<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\modules\catalog\models\root\Product;
use backend\modules\content\models\Question;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\modules\seo\models\MetaTag;
use frontend\modules\seo\models\Script;

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
    <meta name="theme-color" content="#f5f5f5">
    <?php $this->registerCsrfMetaTags() ?>


    <?php MetaTag::setMetaTag($property); ?>
    <title>
        <?= Html::encode($this->title); ?>
    </title>

    <?php $this->head() ?>

    <?php Script::getScripts(Script::BEFORE_END_HEAD); ?>
    
</head>
<body>
<?php $this->beginBody() ?>

<?php Script::getScripts(Script::AFTER_BEGIN_BODY); ?>

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
       
        <?php if (isset($this->blocks['pop-categories'])): ?>
            <?= $this->blocks['pop-categories'] ?>
        <?php endif ?>


        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/product/_faq_bottom', ['questions' => Question::getShareQuestions()]); ?>

    </div>
    <?php Script::getScripts(Script::BEFORE_END_BODY); ?>
</body>

<?= $this->render('_footer', ['settings' => $settings]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
