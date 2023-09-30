
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