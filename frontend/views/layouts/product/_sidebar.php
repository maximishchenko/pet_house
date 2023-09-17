<?php

use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\root\Property;

?>

<div class="product__col-calc" data-product-id="<?= $model->id; ?>" data-csrf-param="<?= Yii::$app->request->csrfParam; ?>" data-csrf-token="<?= Yii::$app->request->csrfToken; ?>">
  <div class="sidebar">
    <div class="sidebar__inner">
      <div class="sidebar-adapt">
        <div class="product__bage-wrapper">
          <?php if ($model->is_available) : ?>
            <span class="product__bage">
              <?= Yii::t('app', 'In available'); ?>
            </span>
          <?php endif; ?>
        </div>
        <h1 class="section-headline product__headline">
          <?= $model->name; ?>
        </h1>
        <div class="tabs calc-tab" data-tabs="calc-tab">
          <ul class="tabs__nav">
            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset" type="button">
                <?= Yii::t('app', "Sidebar Configuration"); ?>
              </button>
            </li>
            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset" type="button">
                <?= Yii::t('app', 'Sidebar Characteristics'); ?>
              </button>
            </li>
          </ul>
          <div class="tabs__content">
            <div class="tabs__panel">
              <div class="calc-el">
                <button class="<?= $model->getConstructorCssClass(); ?>" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" data-constructor-color-id="<?= $model->color->id; ?>" data-constructor-color-image style="background-image: url(<?= "/" . Property::UPLOAD_PATH . "/" . $model->color->image; ?>);">
                    </span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title">
                        <?= Yii::t('app', 'Base color'); ?>
                      </span>
                      <span class="calc-el__btn-val" data-constructor-color-name>
                        <?= $model->color->name ?>
                      </span>
                    </span>
                  </span>
                  <span class="calc-el__btn-icons">
                    <svg>
                      <use class="calc-el__btn-pen" xlink:href="/img/sprite.svg#pen"></use>
                      <use class="calc-el__btn-close" xlink:href="/img/sprite.svg#close"></use>
                    </svg>
                  </span>
                </button>
                <div class="calc-el__dropdown" data-simplebar data-simplebar-auto-hide="false">
                  <div class="calc-el__list">
                    <?php foreach ($model->getColorItems() as $color) : ?>
                      <span class="calc-el__list-item color-item" style="background-image: url(/uploads/property/<?= $color->image; ?>);" data-color-id="<?= $color->id; ?>" data-color-name="<?= $color->name ?>" data-color-image="<?= "/" . Property::UPLOAD_PATH . "/" . $color->image; ?>">

                      </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <!-- Размеры -->
              <div class="calc-el">
                <!-- TODO Класс для блокировки -->
                <button class="<?= $model->getConstructorCssClass(); ?>" type="button"> 
                  <span class="calc-el__btn-wrapper">
                    <span 
                      class="calc-el__btn-preview"
                      data-constructor-size-id="<?= $model->size->id; ?>"
                      data-constructor-size-height="<?= $model->size->height; ?>"
                      data-constructor-size-width="<?= $model->size->width; ?>"
                      data-constructor-size-depth="<?= $model->size->depth; ?>"
                      style="background-image: url('/img/size.jpg');"
                    ></span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title"><?= Yii::t('app', 'Base Size'); ?></span>
                      <span class="calc-el__btn-val">
                        <?= Yii::t('app', 'Size Height'); ?><span id="constructor_height"><?= $model->size->height; ?></span>
                        <?= Yii::t('app', 'Size Width'); ?><span id="constructor_width"><?= $model->size->width; ?></span>
                        <?= Yii::t('app', 'Size Depth'); ?><span id="constructor_depth"><?= $model->size->depth; ?></span>
                        <?= Yii::t('app', 'Size mm'); ?>
                      </span>
                    </span>
                  </span>
                  <span class="calc-el__btn-icons">
                    <svg>
                      <use class="calc-el__btn-pen" xlink:href="/img/sprite.svg#pen"></use>
                      <use class="calc-el__btn-close" xlink:href="/img/sprite.svg#close"></use>
                    </svg>
                  </span>
                </button>
                <div class="calc-el__dropdown" data-simplebar data-simplebar-auto-hide="false">

                <div class="<?= $model->getSizesConstructorBlockCssClassList() ?>">
                  <?php if($model->product_type == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE): ?>

                      <?= $this->render('//layouts/product/_constructor_items/_dog_cage_size', []); ?>

                  <?php else: ?>

                      <?= $this->render('//layouts/product/_constructor_items/_all_items_size', ['model' => $model]); ?>

                  <?php endif; ?>
                </div>

                </div>
              </div>
              <!-- Размеры -->

              <!-- Боковые стенки -->
              <div class="calc-el">
                <button class="<?= $model->getConstructorCssClass(); ?>" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" data-constructor-wall-id="<?= $model->wall->id; ?>" style="background-image: url('/img/color.jpg');"></span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title"><?= Yii::t('app', 'Base material'); ?></span>
                      <span class="calc-el__btn-val" data-constructor-wall-name>
                        <?= $model->wall->name; ?>
                      </span>
                    </span>
                  </span>
                  <span class="calc-el__btn-icons">
                    <svg>
                      <use class="calc-el__btn-pen" xlink:href="/img/sprite.svg#pen"></use>
                      <use class="calc-el__btn-close" xlink:href="/img/sprite.svg#close"></use>
                    </svg>
                  </span>
                </button>
                <div class="calc-el__dropdown" data-simplebar data-simplebar-auto-hide="false">
                  <div class="calc-el__list">
                    <?php foreach ($model->getAvailableProductSideWalls() as $wall) : ?>

                      <?= $this->render('//layouts/product/_constructor_items/_all_wall', ['wall' => $wall]); ?>

                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <!-- Боковые стенки -->

            </div>
            <!-- Характеристики -->
            <div class="tabs__panel">
              <div class="specifications">
                <ul class="list-reset specifications__list">
                  <?php foreach ($model->productAttributes as $attribute) : ?>
                    <li class="specifications__el">
                      <span class="specifications__title">
                        <?= $attribute->name; ?>
                      </span>
                      <span class="specifications__value">
                        <?= $attribute->value; ?>
                      </span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>

          </div>
        </div>
        <div class="product__price-row">
          <span class="product__price-desc">
            <?= Yii::t('app', 'Price with content'); ?>
          </span>
          <span class="product__price">
            <span id="constructor_price">
              <?= number_format($model->price, 0, '', ' '); ?>
            </span> ₽

            <?php if(isset($model->discount) && $model->discount > 0): ?>
            <span class="product__price-old" id="constructor_price_old">
              <?= number_format($model->oldPrice, 0, '', ' '); ?>
            </span> ₽
            <?php endif; ?>

          </span>
        </div>
        <button class="btn-reset btn-a product__action-btn" type="button" data-add-to-cart>
          <?= Yii::t('app', 'To cart'); ?>
        </button>
      </div>
    </div>
  </div>
</div>
