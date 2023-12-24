<?php

use frontend\modules\cart\models\CartProduct;
use yii\helpers\Url;

$productItem = new CartProduct();
$oneProduct = $productItem->getProductNameWithImage($product[CartProduct::PRODUCT_ID]);
?>

<div class="cart-el">

    <span class="cart-el__img" style="background-image: url('<?= $oneProduct[CartProduct::IMAGE]; ?>');"></span>

    <div class="cart-el__inner">
        <div class="cart-el__title">
            <?= $oneProduct[CartProduct::NAME]; ?>
        </div>
        <div class="cart-el__subtitle">
            <?php if ($productItem->getWallName($product[CartProduct::WALL_ID])) : ?>
                <?= $productItem->getWallName($product[CartProduct::WALL_ID]); ?>,
            <?php endif; ?>
            <?= $productItem->getColorName($product[CartProduct::COLOR_ID]); ?>,
            <?= $product[CartProduct::HEIGHT] . '×' . $product[CartProduct::WIDTH] . '×' . $product[CartProduct::DEPTH] . ' см'; ?>
        </div>
    </div>

    <div class="cart-score">
        <button class="cart-score__min btn-reset counter__btn-min" type="button" data-product-id="<?= $productKey; ?>" title="Удалить"></button>

        <span class="cart-score__val counter__val">
            <?= $product[CartProduct::COUNT]; ?>
        </span> <span>шт.</span>
        <button class="cart-score__plus btn-reset counter__btn-plus" type="button" data-product-id="<?= $productKey; ?>" title="Добавить"></button>
    </div>

    <span class="cart-el__price">
        <span class="cart-el__price-inner">
            <?php $productPrice = $product[CartProduct::COUNT] * $product[CartProduct::PRICE]; ?>
            <?= Yii::$app->formatter->asDecimal($productPrice, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
        </span>
        <span>₽</span>
    </span>

    <a href="<?= Url::toRoute(['/cart/delete-item', 'itemKey' => $productKey]); ?>" class="cart-el__del btn-reset" type="button" title="Удалить">
        <svg class="cart-el__del-icon">
            <use xlink:href="img/sprite.svg#close"></use>
        </svg>
    </a>
</div>