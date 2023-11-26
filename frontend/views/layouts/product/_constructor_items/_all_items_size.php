<?php

use backend\modules\catalog\models\root\Property;
?>

<?php foreach ($model->getAvailableProductSizes() as $size) : ?>
    <span class="calc-el__list-item calc-el__list-item--size size-item <?= ($model->size_id == $size->id) ? 'calc-el__list-item--active' : null; ?>" data-size-id="<?= $size->id; ?>" data-size-height="<?= $size->height; ?>" data-size-width="<?= $size->width; ?>" data-size-depth="<?= $size->depth; ?>" data-size-height-price="<?= $size->height_price; ?>" data-size-width-price="<?= $size->width_price; ?>" data-size-depth-price="<?= $size->depth_price; ?>">
        <span class="calc-el__list-item-ineer">
            <span class="calc-el__list-item-img" style="background-image: url('/<?= Property::UPLOAD_PATH . $size->image; ?>');"></span>
            <span> + <?= $size->price; ?></span>
        </span>
    </span>
<?php endforeach; ?>

<span data-start-step-height="0"></span>
<span data-current-step-height="0"></span>
<span data-minimal-step-height="0"></span>
<span data-step-price-height="0"></span>

<span data-start-step-width="0"></span>
<span data-current-step-width="0"></span>
<span data-minimal-step-width="0"></span>
<span data-step-price-width="0"></span>

<span data-start-step-depth="0"></span>
<span data-current-step-depth="0"></span>
<span data-minimal-step-depth="0"></span>
<span data-step-price-depth="0"></span>

<span data-step-size="0"></span>
<!-- onclick="setConstructorSize(this); return false" -->