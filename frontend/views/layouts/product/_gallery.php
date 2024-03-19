<?php

use backend\modules\catalog\models\root\CategoryUpload;
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
  <?php if($model->category->uploads): ?>
  <div class="gallary-photo">
    <h2 class="gallary-photo__title">Фото галерея</h2>
    <div class="swiper gallary-photo__swiper">
      <div class="swiper-wrapper">

        <?php foreach($model->category->uploads as $upload): ?>
        <div class="swiper-slide gallary-photo__slide">
          <a class="gallary-photo__link" href="/<?= CategoryUpload::UPLOAD_PATH . $upload->file_path; ?>" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/<?= CategoryUpload::PREVIEW_UPLOAD_PATH . $upload->file_path; ?>">
          </a>
        </div>

        <!-- <div class="swiper-slide gallary-photo__slide gallary-photo__slide--video">
          <a class="gallary-photo__link" href="img/photos/v1.mov" data-fancybox="gallary-photo">
            <img class="gallary-photo__img" src="/img/photo/1.jpg" alt="">
          </a>
        </div> -->
        <?php endforeach; ?>

      </div>
      <div class="swiper-button-next gallary-photo-button-next"></div>
      <div class="swiper-button-prev gallary-photo-button-prev"></div>
      <div class="swiper-scrollbar gallary-photo-scrollbar"></div>
    </div>
  </div>
  <?php endif; ?>