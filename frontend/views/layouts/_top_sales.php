<?php

use backend\modules\catalog\models\root\Product;
use common\models\Status;

$topSales = Product::find()
    ->where([
        'status' => Status::STATUS_ACTIVE,
        'item_type' => $model->item_type,
        'product_type' => $model->product_type
    ])
    ->orderBy(['view_count' => SORT_DESC])
    ->all();
?>
<?php if (!empty($topSales)) : ?>
    <section class="thumb-slider mt-xxl mb-xxl">
        <div class="container">
            <div class="thumb-slider__head">
                <h2 class="section-headline">
                    <?php if (isset($title) && !empty($title)) : ?>
                        <?= $title; ?>
                    <?php endif; ?>
                </h2>
                <div class="thumb-slider__controls">
                    <div class="swiper-button-prev thumb-slider-button-prev"></div>
                    <div class="swiper-button-next thumb-slider-button-next"></div>
                </div>
            </div>
            <div class="swiper prod-slider">
                <div class="swiper-wrapper">

                    <?php foreach ($topSales as $productItem) : ?>
                        <div class="swiper-slide">
                            <a href="#" class="thumb-prod">
                                <div class="thumb-prod__img-wrapper">
                                    <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
                                </div>
                                <div class="thumb-prod__info">
                                    <span class="thumb-prod__price">
                                        <?= Yii::$app->formatter->asCurrency($productItem->price, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
                                        <?php if ($productItem->oldPrice > $productItem->price) : ?>
                                            <span class="thumb-prod__price-old">
                                                <?= Yii::$app->formatter->asCurrency($productItem->oldPrice, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                    <h3 class="thumb-prod__title">
                                        <?= $productItem->name; ?>
                                    </h3>
                                    <span class="thumb-prod__desc">
                                        В<?= $productItem->size->height; ?> Ш<?= $productItem->size->width; ?> Г<?= $productItem->size->depth; ?> см, <?= $productItem->material->name; ?>
                                    </span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>

<?php endif; ?>
