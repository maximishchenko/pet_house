<section class="thumb-slider mt-xxl mb-xxl">
  <div class="container">
    <div class="thumb-slider__head">
      <h2 class="section-headline">
        <?= $title; ?>
      </h2>
      <div class="thumb-slider__controls">
        <div class="swiper-button-prev thumb-slider-button-prev"></div>
        <div class="swiper-button-next thumb-slider-button-next"></div>
      </div>
    </div>
  </div>
    <div class="swiper prod-slider pl-sl">
    <div class="swiper-wrapper">

      <?php foreach($products as $product): ?>
      <div class="swiper-slide">
        <!-- TODO сгенерировать ссылки на карточку -->
        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">
              <?= Yii::$app->formatter->asCurrency($product->price, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>

              <?php if(isset($product->oldPrice) && !empty($product->oldPrice)): ?>

                <span class="thumb-prod__price-old">
                  <?= Yii::$app->formatter->asCurrency($product->oldPrice, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]); ?>
                </span>

              <?php endif; ?>

            </span>
            <h3 class="thumb-prod__title">
              <?= $product->name; ?>
            </h3>
            <span class="thumb-prod__desc">
              <?= Yii::t('app', 'Height {height} Width {width} Depth {depth} mm', ['height' => $product->size->height, 'width' => $product->size->width, 'depth' => $product->size->depth]); ?>, 
              <?= $product->material->name; ?>
            </span>
          </div>
        </a>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>
