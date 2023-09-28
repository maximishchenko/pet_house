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
    'pager'=>[
        'maxButtonCount' => 5,
        'options'=>[
            'class'=>'paginator',
        ]
    ],
]); 
?>