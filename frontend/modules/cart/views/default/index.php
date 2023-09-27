<?php

use common\components\Word;
use frontend\modules\cart\models\Cart;

$this->title = Yii::t('app', 'Cart');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="cart mb-xxl">
    <div class="container cart-container">

        <div class="cart__head mb-s">
            <h1 class="section-headline">
                <?= Yii::t('app', "In Cart"); ?> <span class="cart__val">
                    <?= Word::numWord(Cart::getTotalCount(), ['товар', 'товара', 'товаров']); ?>
                </span>
            </h1>
        </div>

        <div class="cart__wrapper">
            <div class="cart__list">

                <?php if(Cart::getTotalCount() > 0): ?>
                
                <!-- Товары в корзине -->
                <?php foreach($cart->getProducts() as $product): ?>
                <div class="cart__list-inner">
                    <?= $this->render('_cart_items', ['product' => $product]); ?>
                </div>
                <?php endforeach; ?>

                <div class="list-order">
                    <div class="list-order__wrapper">
                        <span class="list-order__subtitle">
                            <?= Yii::t('app', "Total amount"); ?> 
                        </span>
                        <span class="list-order__price">
                            <span class="total__cart__price">
                                <?= number_format(Cart::getTotalPrice(), 0, '', ' '); ?>
                            </span> ₽
                        </span>
                        <span class="list-order__subtitle">
                            <?= Yii::t('app', 'Total amount except delivery'); ?> 
                        </span>
                    </div>
                </div>

                <?php endif; ?>

                <!-- Вам может подойти -->
                <?= $this->render('//layouts/_item_slider'); ?>

                <!-- Форма оформления заказа -->
                <?= $this->render('_cart_order_form', ['order' => $order]); ?>
        </div>
    </div>
</section>
<!-- Вопросы и ответы -->
<?= $this->render('//layouts/product/_faq_bottom'); ?>
