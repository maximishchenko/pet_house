<?php

use backend\modules\catalog\models\items\ProductItemType;
use backend\modules\catalog\models\root\Product;
use common\components\Word;
use common\models\Status;
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

        <div class="cart__wrapper"> <!-- TODO Пустая корзина -->
            <div class="cart__list">


                <?php if (Cart::getTotalCount() > 0) : ?>

                    <pre>
                    <?php
                        
                    $columnProductIds = array_column($cart->getProducts(), 'product_id');
                    print_r($columnProductIds);
                    ?>
                    </pre>

                    <!-- Товары в корзине -->
                    <?php foreach ($cart->getProducts() as $productKey => $product) : ?>
                        <div class="cart__list-inner">
                            <?= $this->render('_cart_items', ['product' => $product, 'productKey' => $productKey]); ?>
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
                
                <?php else: ?>
                  
                    <div class="s-cart__el-empty">
                        <div class="s-cart__el-empty__iner">
                            <span>
                                В&nbsp;корзине пусто </span>
                            <p>
                                Посмотрите предложения на&nbsp;главной странице<br> или воспользуйтесь каталогом </p>
                        </div>
                        <a href="/" class="btn-a">
                            Вернуться на&nbsp;главную </a>
                    </div>

                <?php endif; ?>

                <!-- Вам может подойти -->
                <?php $products = Product::find()->where(['status' => Status::STATUS_ACTIVE, 'item_type' => ProductItemType::PRODUCT_TYPE_ACCESSORY])->all(); ?>
                <?= $this->render('//layouts/_item_slider', ['products' => $products]); ?>

                <!-- Форма оформления заказа -->
                <?= $this->render('_cart_order_form', ['order' => $order]); ?>
            </div>
        </div>
</section>
<!-- Вопросы и ответы -->
<?= $this->render('//layouts/product/_faq_bottom'); ?>