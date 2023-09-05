<?php

use yii\widgets\ListView;

?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}",  
    'itemView' => '_catalog_items',
    'options' => [
        'tag' => false,
    ],
]); 
?>