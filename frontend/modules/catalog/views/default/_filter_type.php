<?php

use backend\modules\catalog\models\root\Category;
?>
<?php if (isset($categories) && !empty($categories)) : ?>
  <div class="container">
    <div class="swiper catalog-cat mb-m">
      <div class="swiper-wrapper">

        <?php $queryParams = Yii::$app->request->queryParams; ?>
        <div class="swiper-slide">
          <?php if (!isset($queryParams) || empty($queryParams) || !in_array('category_id', array_keys($queryParams))) : ?>
            <a class="catalog-cat__el catalog-cat__el--active" href="<?= Yii::$app->request->getPathInfo(); ?>">
            <?php else : ?>
              <a class="catalog-cat__el" href="<?= Yii::$app->request->getPathInfo(); ?>">
              <?php endif; ?>
              <img class="catalog-cat__img" src="/img/all_cat_min.webp" alt="">
              <span class="catalog-cat__title">
                Все товары
              </span>
              </a>
        </div>
        <?php foreach ($categories as $category) : ?>
          <div class="swiper-slide">
            <?php
            if (in_array('category_id', array_keys($queryParams)) && $queryParams['category_id'][0] == $category->id) :
            ?>
              <a class="catalog-cat__el catalog-cat__el--active" href="<?= Yii::$app->request->getPathInfo() . '?category_id[]=' . $category->id; ?>">
              <?php else : ?>
                <a class="catalog-cat__el" href="<?= Yii::$app->request->getPathInfo() . '?category_id[]=' . $category->id; ?>">
                <?php endif; ?>
                <!-- <img class="catalog-cat__img" src="/img/catalog/1.png" alt=""> -->
                <img class="catalog-cat__img" src="/<?= Category::UPLOAD_PATH . $category->image; ?>" alt="<?= $category->name; ?>">
                <span class="catalog-cat__title">
                  <?= $category->name; ?>
                </span>
                </a>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-scrollbar"></div>
      <!--      <div class="swiper-button-next catalog-cat__btn-next"></div>
      <div class="swiper-button-prev catalog-cat__btn-prev"></div> -->
    </div>
  </div>
<?php endif; ?>