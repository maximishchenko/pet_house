<?php
use yii\helpers\Html;

function isActionActive(array $actArray) {
    $action = Yii::$app->controller->action->id;
    foreach ($actArray as $act) {
        if ($act == $action) {
            return 'nav-link active';
        }
    }
    return 'nav-link';
}
?>

<ul class="nav nav-tabs admin__tabs" style="margin-bottom: 30px !important;">
  <li class="nav-item">
    <?= Html::a('Карточка витрины', ['update', 'id' => $model->id], ['class' => isActionActive(['update'])]); ?>
  </li>
  <li class="nav-item">
    <?= Html::a('Аксессуары', ['accessories', 'id' => $model->id], ['class' => isActionActive(['accessories'])]); ?>
  </li>
  <li class="nav-item">
    <?= Html::a('Калькуляция', ['price', 'id' => $model->id], ['class' => isActionActive(['price'])]); ?>
  </li>
</ul>