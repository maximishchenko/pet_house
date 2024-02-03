<?php if (isset($questions) && !empty($questions)): ?>
<section class="main-faq">
  <div class="container">

    <h2 class="section-headline mb-s">
      <?= Yii::t('app', 'FAQ_BOTTOM'); ?>
    </h2>

    <div class="main-faq__wrapper">
      <!-- <div class="main-faq__col"> -->

      <?php foreach ($questions as $question): ?>
        <div class="main-faq__el q-el">
          <button class="btn-reset main-faq__btn q-btn">
            <span class="main-faq__headline">
              <?= $question->question; ?>
            </span>
            <svg class="main-faq__icon q-icon">
              <use xlink:href="/img/sprite.svg#plus"></use>
            </svg>
          </button>
          <div class="main-faq__content q-content">
            <p><?= $question->answer; ?></p>
          </div>
        </div>
      <?php endforeach; ?>

      <!-- </div> -->
    </div>
  </div>
</section>
<?php endif; ?>