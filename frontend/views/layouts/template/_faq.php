<?php

use backend\modules\content\models\Question;
use common\models\Status;

$questions = Question::find()->where([
  'status' => Status::STATUS_ACTIVE,
  'position' => Question::POSITION_CARD
])->orderBy(['sort' => SORT_DESC])->asArray()->all();
$medianQuestion = count(array_keys($questions)) / 2;
?>

<section class="main-faq">
  <div class="container">
    <h2 class="section-headline mb-s"><?= Yii::t('app', 'Answers and questions'); ?></h2>
    <div class="main-faq__wrapper">

    <div class="main-faq__col"> 
      <?php foreach ($questions as $qKey => $question): ?>
        
        <?php if ($qKey == $medianQuestion): ?>
          </div>
          <div class="main-faq__col">  
        <?php endif; ?>


        <div class="main-faq__el q-el">
          <button class="btn-reset main-faq__btn q-btn">
            <span class="main-faq__headline">
              <?= $questions[$qKey]['question']; ?>
            </span>
            <svg class="main-faq__icon q-icon">
              <use xlink:href="/img/sprite.svg#plus"></use>
            </svg>
          </button>
          <div class="main-faq__content q-content">
            <div class="main-faq__content-in">
              <?= $questions[$qKey]['answer']; ?>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
          </div>

    </div>
  </div>
</section>