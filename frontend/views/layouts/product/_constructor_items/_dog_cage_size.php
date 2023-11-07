<div 
  id="dogCageSizeParams" 
  data-product-price="<?= $model->price; ?>" 
  data-height-price="<?= $model->size->height_price; ?>" 
  data-width-price="<?= $model->size->width_price; ?>" 
  data-depth-price="<?= $model->size->depth_price; ?>"
></div>

  <div class="calc-el__list-slider-wrapper">
    <div class="calc-el__list-head">
      <span class="calc-el__list-title">Высота:</span>
      <span 
        class="calc-el__list-val" 
        id="constructor_height_val" 
        data-slider-height="<?= $model->size->height; ?>"
        data-slider-min-height="<?= $model->size->min_height; ?>"
        data-slider-max-height="<?= $model->size->max_height; ?>"
        data-slider-step-height="<?= $model->size->step; ?>"
      >
        <?= $model->size->height; ?>
      </span>
    </div>
    <div id="slider-h" class="calc-el__slider"></div>
  </div>
  <div class="calc-el__list-slider-wrapper">
    <div class="calc-el__list-head">
      <span class="calc-el__list-title">Ширина:</span>
      <span 
        class="calc-el__list-val" 
        id="constructor_width_val" 
        data-slider-width="<?= $model->size->width; ?>"
        data-slider-min-width="<?= $model->size->min_width; ?>"
        data-slider-max-width="<?= $model->size->max_width; ?>"
        data-slider-step-width="<?= $model->size->step; ?>"
      >
        <?= $model->size->width; ?>
      </span>
    </div>
    <div id="slider-w" class="calc-el__slider"></div>
  </div>
  <div class="calc-el__list-slider-wrapper">
    <div class="calc-el__list-head">
      <span class="calc-el__list-title">Глубина:</span>
      <span 
        class="calc-el__list-val" 
        id="constructor_depth_val" 
        data-slider-depth="<?= $model->size->depth; ?>"
        data-slider-min-depth="<?= $model->size->min_depth; ?>"
        data-slider-max-depth="<?= $model->size->max_depth; ?>"
        data-slider-step-depth="<?= $model->size->step; ?>"
      >
        <?= $model->size->depth; ?>
      </span>
    </div>
    <div id="slider-g" class="calc-el__slider"></div>
  </div>

  
<span data-start-step-height="<?= $model->size->height; ?>"></span>
<span data-current-step-height="<?= $model->size->height; ?>"></span>
<span data-minimal-step-height="<?= $model->size->min_height; ?>"></span>
<span data-step-price-height="<?= $model->size->height_price; ?>"></span>

<span data-start-step-width="<?= $model->size->width; ?>"></span>
<span data-current-step-width="<?= $model->size->width; ?>"></span>
<span data-minimal-step-width="<?= $model->size->min_width; ?>"></span>
<span data-step-price-width="<?= $model->size->width_price; ?>"></span>

<span data-start-step-depth="<?= $model->size->depth; ?>"></span>
<span data-current-step-depth="<?= $model->size->depth; ?>"></span>
<span data-minimal-step-depth="<?= $model->size->min_depth; ?>"></span>
<span data-step-price-depth="<?= $model->size->depth_price; ?>"></span>

<span data-step-size="<?= $model->size->step; ?>"></span>