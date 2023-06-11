<?php

use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\root\Property;
use common\models\Status;

?>

<script src="/js/constructor.js"></script>

<div class="product__col-calc">
    <div class="sidebar">
      <div class="sidebar__inner">
        <div class="product__bage-wrapper">
          <?php if ($model->is_available): ?>
            <span class="product__bage">
              <?= Yii::t('app', 'In available'); ?>
            </span>
          <?php endif; ?>
        </div>
        <h1 class="section-headline product__headline">
          <?= $model->name; ?>
        </h1>
        <div class="tabs" data-tabs="calc-tab">
          <ul class="tabs__nav">
            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset"
                type="button">
                  <?= Yii::t('app', "Sidebar Configuration"); ?>
              </button>
            </li>
            <li class="tabs__nav-item">
              <button class="tabs__nav-btn btn-reset"
                type="button">
                  <?= Yii::t('app', 'Sidebar Characteristics'); ?>
              </button>
            </li>
          </ul>
          <div class="tabs__content">
            <div class="tabs__panel">
              <div class="calc-el">
                <button class="calc-el__btn-control btn-reset" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" data-constructor-color-image style="background-image: url(<?= "/" . Property::UPLOAD_PATH . "/" . $model->color->image; ?>);">
                    </span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title">
                        <?= Yii::t('app', 'Base color'); ?>
                      </span>
                      <span class="calc-el__btn-val" data-constructor-color-name>
                        <?= $model->color->name?>
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
                    <?php foreach ($model->getColorItems() as $color): ?>
                      <span 
                        onclick="setConstructorColor(this); return false"
                        class="calc-el__list-item" 
                        style="background-image: url(/uploads/property/<?= $color->image; ?>);" 
                        data-color-name="<?= $color->name?>" 
                        data-color-image="<?= "/" . Property::UPLOAD_PATH . "/" . $color->image; ?>"
                      >

                      </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              
              <!-- Размеры -->
              <div class="calc-el">
                <button class="calc-el__btn-control btn-reset" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" style="background-image: url('/img/size.jpg');"></span>
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
                  <div class="calc-el__list">
                    <?php foreach ($model->productType->sizes as $size): ?>
                    <span class="calc-el__list-item" 
                          style="background-image: url('/<?= Property::UPLOAD_PATH . $size->image; ?>');"
                          data-size-height="<?= $size->height; ?>"
                          data-size-width="<?= $size->width; ?>"
                          data-size-depth="<?= $size->depth; ?>"
                          onclick="setConstructorSize(this); return false"
                    >

                    </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

              <!-- Боковые стенки -->
              <div class="calc-el">
                <button class="calc-el__btn-control btn-reset" type="button">
                  <span class="calc-el__btn-wrapper">
                    <span class="calc-el__btn-preview" style="background-image: url('/img/color.jpg');"></span>
                    <span class="calc-el__btn-text">
                      <span class="calc-el__btn-title"><?= Yii::t('app', 'Base material'); ?></span>
                      <span class="calc-el__btn-val" data-constructor-wall-name>
                        <?= $model->material->name; ?>
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
                    <?php foreach (Property::find()->where(['status' => Status::STATUS_ACTIVE, 'property_type' => $model->product_type, 'item_type' => PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL])->all() as $wall): ?>
                      <span 
                        class="calc-el__list-item"
                        style="background-image: url('/<?= Property::UPLOAD_PATH . $wall->image; ?>');"
                        data-wall-name = "<?= $wall->name; ?>"
                        onclick="setConstructorWall(this); return false"
                      >
                    </span>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>

            </div>
            <!-- Характеристики -->
            <div class="tabs__panel">
              <div class="specifications">
                <ul class="list-reset specifications__list">
                  <?php foreach($model->productAttributes as $attribute): ?> 
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
            <?= Yii::$app->formatter->asCurrency($model->price); ?>  
            <span class="product__price-old">
              <?= Yii::$app->formatter->asCurrency($model->oldPrice); ?> 
            </span>
          </span>
        </div>
        <button class="btn-reset btn-a product__action-btn" type="button">
          <?= Yii::t('app', 'To cart'); ?>
        </button>
      </div>
    </div>
  </div>
