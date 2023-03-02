<?php
use yii\helpers\Html;
?>

<header class="header">
    <div class="container">
        <div class="header__wrapper">
        <a href="<?= Yii::$app->homeUrl; ?>" class="logo">
            <img class="logo__img" src="/img/logo.svg" alt="">
        </a>
        <nav class="nav" title="">
            <ul class="list-reset nav__list">
                <li class="nav__item"><a href="/chinchilles" class="nav__link">Шиншиллы</a></li>
                <li class="nav__item"><a href="/dogs" class="nav__link">Собаки</a></li>
                <li class="nav__item"><a href="/cats" class="nav__link">Кошки</a></li>
                <li class="nav__item"><a href="/birds" class="nav__link">Птицы</a></li>
                <li class="nav__item">
                    <a href="javascript::void();" class="nav__link">
                        <?= Yii::t('app', 'Personal Order'); ?>
                    </a>
                </li>
                <li class="nav__item">
                    <?= Html::a(Yii::t('app', 'Delivery and Payment'), ['/delivery'], ['class' => "nav__link"]); ?>
                </li>
            </ul>
        </nav>
        <?php if (!empty($settings->getItemValue('contactPhone'))): ?>
            <a href="tel:<?= $settings->getItemValue('contactPhone'); ?>" class="header__phone">
                <?= $settings->getItemValue('contactPhone'); ?>
            </a>
        <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cart'), ['/cart'], ['class' => 'header__phone']); ?>
        </div>
    </div>
</header>
