<?php

use backend\modules\catalog\models\root\Product;
?>

<div class="product-gallary">
  <div class="swiper product-gallary__swiper">
    <div class="swiper-wrapper">
      <?php foreach ($model->productImages as $k => $image) : ?>
        <?php if ($k < 2) : ?>
          <div class="swiper-slide">
          <?php else : ?>
            <div class="swiper-slide swiper-slide--50">
            <?php endif; ?>
            <a class="product-gallary__link" href="<?= "/" . Product::UPLOAD_PATH . $image->image . "?v=" . $image->id; ?>" data-fancybox="product-gallery">
              <img class="product-gallary__img" src="<?= "/" . Product::UPLOAD_PATH . $image->image . "?v=" . $image->id; ?>" alt="<?= $image->image; ?>">
            </a>
            </div>
          <?php endforeach; ?>
          </div>
          <div class="swiper-pagination product-gallary--pag"></div>
    </div>
  </div>

  <!--  TODO Новый слайдер -->

  <div class="gallary-photo">
    <h2 class="gallary-photo__title">Фото галерея</h2>
    <div class="swiper gallary-photo__swiper">
      <div class="swiper-wrapper">

        <div class="swiper-slide gallary-photo__slide">
          <a class="gallary-photo__link" href="img/photos/1.jpg" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/1.jpg" alt="">
          </a>
        </div>

        <div class="swiper-slide gallary-photo__slide gallary-photo__slide--video">
          <a class="gallary-photo__link" href="img/photos/v1.mov" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/1.jpg" alt="">
          </a>
        </div>

        <div class="swiper-slide gallary-photo__slide">
          <a class="gallary-photo__link" href="/img/photos/2.jpg" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/2.jpg" alt="">
          </a>
        </div>
        <div class="swiper-slide gallary-photo__slide">
          <a class="gallary-photo__link" href="/img/photos/3.jpg" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/3.jpg" alt="">
          </a>
        </div>
        <div class="swiper-slide gallary-photo__slide">
          <a class="gallary-photo__link" href="/img/photos/4.jpg" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/4.jpg" alt="">
          </a>
        </div>

      </div>
      <div class="swiper-button-next gallary-photo-button-next"></div>
      <div class="swiper-button-prev gallary-photo-button-prev"></div>
      <div class="swiper-scrollbar gallary-photo-scrollbar"></div>
    </div>
  </div>