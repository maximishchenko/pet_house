<?php

use backend\modules\catalog\models\root\Property;

?>
<span 
    class="calc-el__list-item" 
    style="background-image: url('/<?= Property::UPLOAD_PATH . $wall->image; ?>');" 
    data-wall-id="<?= $wall->id; ?>" 
    data-wall-name="<?= $wall->name; ?>" 
    onclick="setConstructorWall(this); return false"
>
</span>