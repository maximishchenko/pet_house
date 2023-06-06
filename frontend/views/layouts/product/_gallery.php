<?php 
use backend\modules\catalog\models\root\Product;
?>

<div class="product-gallary">
    <div class="swiper product-gallary__swiper">
        <div class="swiper-wrapper">
            <?php foreach($model->productImages as $k => $image): ?>
              <?php if($k < 2): ?>
                <div class="swiper-slide">
              <?php else: ?>
                <div class="swiper-slide swiper-slide--50">
              <?php endif; ?>
                  <a class="product-gallary__link" href="<?= "/" . Product::UPLOAD_PATH . $image->image . "?v=" . $image->id; ?>" data-fancybox="product-gallery">
                    <img class="product-gallary__img" src="<?= "/" . Product::UPLOAD_PATH . $image->image . "?v=" . $image->id; ?>" alt="<?= $image->image; ?>">
                  </a>
              </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>