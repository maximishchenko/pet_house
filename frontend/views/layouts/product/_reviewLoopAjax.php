<?php

use yii\widgets\ListView;

?>
<?= ListView::widget([
    'dataProvider' => $reviewsDataProvider,
    'layout' => "{items}",  
    'itemView' => '_review_items',
    'options' => [
        'tag' => false,
    ],
    'itemOptions' => ['tag' => null],
    'pager'=>[
        'maxButtonCount' => 5,
        'options'=>[
            'class'=>'paginator',
        ]
    ],
]); 
?>