
<?php
use backend\modules\catalog\models\root\Property;
?>

<?php foreach ($model->getAvailableProductSizes() as $size) : ?>
    <span 
        class="calc-el__list-item size-item" style="background-image: url('/<?= Property::UPLOAD_PATH . $size->image; ?>');" 
        data-size-id="<?= $size->id; ?>" 
        data-size-height="<?= $size->height; ?>" 
        data-size-width="<?= $size->width; ?>" 
        data-size-depth="<?= $size->depth; ?>" 
    >
    </span>
<?php endforeach; ?>

<!-- onclick="setConstructorSize(this); return false" -->