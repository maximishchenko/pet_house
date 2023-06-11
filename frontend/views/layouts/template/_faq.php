<?php

use backend\modules\content\models\Question;
use common\models\Status;

$questions = Question::find()->where([
  'status' => Status::STATUS_ACTIVE,
  'position' => Question::POSITION_CARD
])->orderBy(['sort' => SORT_DESC])->asArray()->all();
$medianQuestion = count(array_keys($questions)) / 2;
?>

<section class="product-faq">
  <h2 class="product-headline product-faq__headline"><?= Yii::t('app', 'Answers and questions'); ?></h2>

  <?php foreach ($questions as $qKey => $question) : ?>
    <div class="product-faq__el q-el">
      <button class="btn-reset product-faq__btn q-btn" type="button"><?= $questions[$qKey]['question']; ?>
        <svg class="product-faq__icon q-icon">
          <use xlink:href="/img/sprite.svg#plus"></use>
        </svg>
      </button>
      <div class="product-faq__content q-content">
        <p><?= $questions[$qKey]['answer']; ?></p>
      </div>
    </div>
  <?php endforeach; ?>

</section>
