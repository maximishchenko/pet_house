<?php

use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentProduct */

$this->title = Yii::t('app', 'Accessory for Rodent Product: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CATALOG_MODULE'), 'url' => ['/catalog']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rodent Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Update Rodent Product: {name}', ['name' => $model->name]), 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('//layouts/_product_tabs', ['model' => $model]); ?>

<p class="text-right">
    <?= Html::a(Yii::t('app', 'Add Accessory Record'), ['add-accessory', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']); ?>
</p>

<?php



$dataProvider = new ActiveDataProvider([
    'query' => $model->getAccessoriesData(),
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    // 'showFooter' => true,
    
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'accessory.name',
        ],
        [
            'attribute' => 'accessory.price',
            'value' => function($data) {
                return Yii::$app->formatter->asCurrency($data->accessory->price);
            }
        ],
        [
            'attribute' => 'count',
        ],
        
        [
            'class' => ActionColumn::className(),
            'contentOptions' => ['style' => 'width:100px;'],
            'template' => '{delete-accessory}',
            'buttons' => [
                'delete-accessory' => function($url, $model, $key) {
                    return Html::a(
                        '<i class="fa fa-trash"></i>', $url, []
                    );
                },
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'delete-accessory') {
                        return Url::toRoute(['delete-accessory', 'product_id' => $model->id, 'accessory_id' => $model->accessory_id]);
                    } else {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                }
            ]
        ],
    ],
]);

?>