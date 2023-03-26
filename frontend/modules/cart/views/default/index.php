<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][] = $this->title;

?>
<section class="cart mb-xxl">
    <div class="container">

        <div class="cart__head mb-s">
            <h1 class="section-headline">
                <?= Yii::t('app', "In Cart"); ?> <span class="cart__val">2 товара</span>
            </h1>
        </div>

        <div class="cart__wrapper">
            <div class="cart__list">
                
                <!-- Товары в корзине -->
                <div class="cart__list-inner">
                    <?= $this->render('_cart_items'); ?>
                </div>

                <div class="list-order">
                    <div class="list-order__wrapper">
                        <span class="list-order__subtitle">
                            <?= Yii::t('app', "Total amount"); ?> 
                        </span>
                        <span class="list-order__price">40 000 ₽</span>
                        <span class="list-order__subtitle">
                            <?= Yii::t('app', 'Total amount except delivery'); ?> 
                        </span>
                    </div>
                </div>

                <!-- Вам может подойти -->
                <?= $this->render('//layouts/_item_slider'); ?>

                <!-- Форма оформления заказа -->
                <?= $this->render('_cart_order_form'); ?>
        </div>
    </div>
</section>
<!-- Вопросы и ответы -->
<?= $this->render('//layouts/template/_faq'); ?>