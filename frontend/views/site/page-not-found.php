<?php
use yii\helpers\Html;
?>
<style>
.not-f {
  height: 400px;
  width: 100%;
  background: url("../img/404.svg") no-repeat center;
  background-size: contain;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  color: var(--dark);
}

.not-f__headline {
  font-weight: 600;
  font-size: 20px;
}
.fancybox__counter {
  display: none;
}      
</style>


<section class="not-f">
    <span class="not-f__headline">
      Запрашиваемая страница не найдена
    </span>
    <p>
        Приносим извинения за неудобства
    </p>
    <?= Html::a("На главную", [Yii::$app->homeUrl], ['class' => 'button-a button-a--b']); ?>
</section>