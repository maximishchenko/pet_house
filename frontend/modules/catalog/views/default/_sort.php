<?php

use common\models\Sort;
use yii\helpers\Html;
?>
<div class="catalog-bar__sort-wrapper">

    <button class="btn-reset catalog-bar__sort-title">
        <?= Yii::t('app', 'Sort By'); ?>
        <i>
            <span class="catalog-bar__sort-title--select">
                <?= Sort::getCatalogSortAttribute(); ?>
            </span>
            <svg width="11" class="sort-arrow" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L5.5 5L10 1" stroke="#373737" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </i>
    </button>

    <div class="catalog-bar__sort-toogle catalog-bar__sort-toogle--active">
      <div class="catalog-bar__sort-list">

        <?php foreach(Sort::getCatalogSortItemsArray() as $paramValue => $paramName): ?>
            <?= Html::button($paramName, ['class' => Sort::getCatalogSortSelectItemClassName($paramValue), "data-sort-param" => $paramValue]); ?>
        <?php endforeach; ?>

      </div>
    </div>
    
</div>