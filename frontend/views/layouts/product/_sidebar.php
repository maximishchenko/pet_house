<?php

use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\items\ProductItemType;
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
            
            <?php if($model->item_type == ProductItemType::PRODUCT_TYPE_PRODUCT): ?>
            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset" type="button">
                <?= Yii::t('app', "Sidebar Configuration"); ?>
              </button>
            </li>
            <?php endif; ?>

            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset" type="button">
                <?= Yii::t('app', 'Sidebar Characteristics'); ?>
              </button>
            </li>
          </ul>
          <div class="tabs__content">
            
            <?php if($model->item_type == ProductItemType::PRODUCT_TYPE_PRODUCT): ?>
            <div class="tabs__panel">
              <div class="calc-el calc-el--color">
                <button class="<?= $model->getConstructorCssClass(); ?>" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview"  id="calc-color-img" data-constructor-color-id="<?= $model->color->id; ?>" data-constructor-color-image style="background-image: url(<?= "/" . Property::UPLOAD_PATH . "/" . $model->color->image; ?>);">
                    </span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title">
                        <?= Yii::t('app', 'Base color'); ?>
                      </span>
                      <span class="calc-el__btn-val" id="calc-color-title" data-constructor-color-name>
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
                  <div class="calc-el__list calc-el__list--color">
                    <?php foreach ($model->getColorItems() as $color) : ?>
                      <span class="calc-el__list-item <?= ($model->color_id == $color->id) ? "calc-el__list-item--active" : ""; ?>" style="background-image: url(/uploads/property/<?= $color->image; ?>);"  data-price="<?= $color->price; ?>" data-color-id="<?= $color->id; ?>" data-color-name="<?= $color->name ?>" data-color-image="<?= "/" . Property::UPLOAD_PATH . "/" . $color->image; ?>">
                        <!-- TODO calc-el__list-item--active добавить класс для выбранных элементов -->
                        <span class="calc-el__list-item-ineer">
                          <span><?= $color->name; ?></span>
                          <span>+ <?= $color->price; ?></span>
                        </span>
                      </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <!-- Размеры -->
              <div class="calc-el calc-el--active">
                <button class="calc-el__btn-control btn-reset" type="button"> <!-- TODO Класс для блокировки -->
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" 
                        data-constructor-size-id="<?= $model->size->id; ?>" 
                        data-constructor-size-height="<?= $model->size->height; ?>" 
                        data-constructor-size-width="<?= $model->size->width; ?>" 
                        data-constructor-size-depth="<?= $model->size->depth; ?>" 
                        data-constructor-size-height-price="<?= $model->size->height_price; ?>" 
                        data-constructor-size-width-price="<?= $model->size->width_price; ?>" 
                        data-constructor-size-depth-price="<?= $model->size->depth_price; ?>"
                        style="background-image: url('/img/size.jpg');"
                      >
                    </span>
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

                  <div class="<?= $model->getSizesConstructorBlockCssClassList() ?> calc-el__list--size">
                    <?php if ($model->product_type == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE) : ?>

                      <?= $this->render('//layouts/product/_constructor_items/_dog_cage_size', ['model' => $model]); ?>

                    <?php else : ?>

                      <?= $this->render('//layouts/product/_constructor_items/_all_items_size', ['model' => $model]); ?>

                    <?php endif; ?>
                  </div>

                </div>
              </div>
              <!-- Размеры -->

              <!-- Боковые стенки -->
              <?php if($model->product_type != CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE): ?>
              <div class="calc-el">
                <button class="<?= $model->getConstructorCssClass(); ?>" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview calc-el__btn-preview--wall"  id="calc-walls-img" data-constructor-wall-id="<?= $model->wall->id; ?>" style="background-image: url('/img/color.jpg');"></span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title"><?= Yii::t('app', 'Base material'); ?></span>
                      <span class="calc-el__btn-val"  id="calc-walls-title" data-constructor-wall-name>
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
                  <div class="calc-el__list calc-el__list--walls">
                    <?php foreach ($model->getAvailableProductSideWalls() as $wall) : ?>

                      <?= $this->render('//layouts/product/_constructor_items/_all_wall', ['wall' => $wall, 'model' => $model]); ?>

                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <!-- Боковые стенки -->

            </div>
            <?php endif; ?>


            
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
            <?php if($model->product_type == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $model->item_type != ProductItemType::PRODUCT_TYPE_ACCESSORY): ?>
              <?= Yii::t('app', 'Price with content'); ?>
            <?php else: ?>
              <?= Yii::t('app', 'Price value'); ?>
            <?php endif; ?>
          </span>
          <span class="product__price">
            <span id="constructor_price">
              <?= number_format($model->price, 0, '', ' '); ?>
            </span> ₽

            <?php if (isset($model->discount) && $model->discount > 0) : ?>
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