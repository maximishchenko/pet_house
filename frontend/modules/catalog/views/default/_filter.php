<?php

use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\Property;
use yii\widgets\ActiveForm;

?>

<div class="catalog__side-inner">
  <div class="thumb-filter__mobhead">
    <span class="thumb-filter__mobhead-title">
      <?= Yii::t('app', 'Filter Block'); ?>
    </span>
    <button type="button" class="btn-reset filter-mob_cloase">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0_706_281" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="20" height="20">
          <rect width="20" height="20" fill="#D9D9D9" />
        </mask>
        <g mask="url(#mask0_706_281)">
          <path d="M17.2132 3.07107L3.07102 17.2132M17.2132 17.2132L3.07102 3.07107" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </g>
      </svg>
    </button>
  </div>

  <!-- <form action="" class="thumb-filter"> -->
    <?php
    $form = ActiveForm::begin([
      'id' => 'catalog_search',
      'options' => ['class' => 'thumb-filter' ],
      'action' => ['index'],
      'method' => 'get',
      'enableClientScript' => false,
    ]); 
    ?>


    <fieldset class="thumb-filter__area thumb-filter__area--switch">
      <label for="s1" class="thumb-filter__title thumb-filter__title--switch">
        <?= Yii::t('app', 'Only Available'); ?>
      </label>
      <ul class="list-reset">
        <li>
          <label for="is_available" class="switch">
            <input id="is_available" type="checkbox" class="switch filter__submit" name="is_available" value="1" <?= $searchModel->isAvailableChecked(); ?> >
            <span class="slider round"></span>
          </label>
        </li>
      </ul>
    </fieldset>

    <!-- Категории -->
    <?php if(isset($categories) && !empty($categories)): ?>
    <fieldset class="thumb-filter__area">
      <legend class="thumb-filter__title">
        <?= Yii::t('app', 'Product Category Block'); ?>
      </legend>
      <ul class="list-reset">

        <?php foreach($categories as $category): ?>
        <li class="thumb-filter__li">
          <input class="hide-inp thumb-filter__check1-inp filter__submit" type="checkbox" id="<?= $category->id; ?>" name="category_id[]" value="<?= $category->id; ?>" <?= $searchModel->isCheckboxSearchParamSelected('category_id', $category->id); ?> >
          <label for="<?= $category->id; ?>" class="thumb-filter__check1-label">
            <span class="thumb-filter__check1-img" style="background-image: url('/<?= Category::UPLOAD_PATH . $category->image; ?>');"></span>
            <span>
              <?= $category->name; ?>
            </span>
          </label>
        </li>
        <?php endforeach; ?>
      </ul>
    </fieldset>
    <?php endif; ?>

    <!-- Типы -->
    <?php if(isset($types) && !empty($types)): ?>
    <fieldset class="thumb-filter__area">
      <legend class="thumb-filter__title">
        <?= Yii::t('app', 'Catalog Type Block'); ?>
      </legend>
      <ul class="list-reset">

        <?php foreach($types as $type): ?>
        <li class="thumb-filter__li">
          <input class="hide-inp thumb-filter__check-inp filter__submit" type="checkbox" id="<?= $type->id; ?>" name="type_id[]" value="<?= $type->id; ?>"  <?= $searchModel->isCheckboxSearchParamSelected('type_id', $type->id); ?> >
          <label for="<?= $type->id; ?>" class="thumb-filter__check-ic">
            <img src="/<?= Property::UPLOAD_PATH . $type->image; ?>" aria-hidden="true">
            <span class="thumb-filter__check-title">
              <?= $type->name; ?>
            </span>
          </label>
        </li>
        <?php endforeach; ?>
      </ul>
    </fieldset>
    <?php endif; ?>


    <?php if(isset($heights) && !empty($heights)): ?>
    <fieldset class="thumb-filter__area">
      <legend class="thumb-filter__title">
        <?= Yii::t('app', 'Catalog Height Block'); ?>
      </legend>
      <ul class="list-reset thumb-filter__table">

        <li class="thumb-filter__table-el">
          <input class="hide-inp thumb-filter__table-inp filter__submit" type="radio" id="all_height" name="height_value" value="" >
          <label class="thumb-filter__table-label" for="all_height">
            <?= Yii::t('app', 'All Values'); ?>
          </label>
        </li>

        <?php foreach($heights as $height): ?>
        <li class="thumb-filter__table-el">
          <input class="hide-inp thumb-filter__table-inp filter__submit" type="radio" id="<?= $height->id; ?>" name="height_value" value="<?= $height->height_value; ?>">
          <label class="thumb-filter__table-label" for="<?= $height->id; ?>">
            <?= $height->height_value; ?>
          </label>
        </li>
        <?php endforeach;?>
      </ul>
    </fieldset>
    <?php endif; ?> <!-- visually-hidden -->
    <input type="text" class="visually-hidden sort-inp" name="order" value="name"><!-- TODO Инпут для сортировки-->
    <div class="catalog-sidebar__controls">
      <button type="submimt" class="catalog-sidebar__btn btn-reset btn-b" type="button">
        <?= Yii::t('app', 'Do Search'); ?>
      </button>
      <a class="catalog-sidebar__btn btn-reset btn-b" href="<?= strtok(Yii::$app->request->getUrl(), '?'); ?>" type="button">
          <?= Yii::t('app', "Reset all search"); ?>
      </a>
    </div>
  <!-- </form> -->
  <?php ActiveForm::end(); ?>

</div>
</div>
