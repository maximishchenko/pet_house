<?php

use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\CategoryUpload;
use backend\modules\catalog\models\root\Product;
use common\components\FileType;

?>

<div class="product-gallary mb-l">
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
  <?php if ($model->category->uploads) : ?>
    <div class="gallary-photo">
      <h2 class="gallary-photo__title">Фотогалерея</h2>
      <div class="swiper gallary-photo__swiper">
        <div class="swiper-wrapper">

          <?php foreach ($model->category->uploads as $upload) : ?>
            <div class="swiper-slide gallary-photo__slide">
              <a class="gallary-photo__link" href="/<?= CategoryUpload::UPLOAD_PATH . $upload->file_path; ?>" data-fancybox="gallary-photo">
                <?php if ($upload->file_type == FileType::TYPE_IMAGE) : ?>
                  <img class="gallary-photo__img" src="/<?= CategoryUpload::PREVIEW_UPLOAD_PATH . $upload->file_path; ?>">
                <?php elseif ($upload->file_type == FileType::TYPE_VIDEO) : ?>
                  <img class="gallary-photo__img" src="/<?= Category::POSTER_UPLOAD_PATH . $model->category->video_poster; ?>">
                <?php endif; ?>
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