<?php

use backend\modules\catalog\models\root\Property;

?>
<span class="calc-el__list-item wall-item <?= $model->wall_id == $wall->id ? 'calc-el__list-item--active' : null; ?>" style="background-image: url('/<?= Property::UPLOAD_PATH . $wall->image; ?>');" 
data-wall-id="<?= $wall->id; ?>"  
data-wall-name="<?= $wall->name; ?>" 
data-price="<?= $wall->price; ?>"
>
    <span class="calc-el__list-item-ineer">
        <span><?= $wall->name; ?></span>
        <span>+ <?= $wall->price; ?></span>
    </span>
</span>

<!-- onclick="setConstructorWall(this); return false" -->