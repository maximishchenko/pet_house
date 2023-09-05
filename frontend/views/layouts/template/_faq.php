<?php if (isset($questions) && !empty($questions)): ?>

<section class="product-faq">
  <h2 class="product-headline product-faq__headline"><?= Yii::t('app', 'Answers and questions'); ?></h2>

  <?php foreach ($questions as $question) : ?>
    <div class="product-faq__el q-el">
      <button class="btn-reset product-faq__btn q-btn" type="button"><?= $question->question; ?>
        <svg class="product-faq__icon q-icon">
          <use xlink:href="/img/sprite.svg#plus"></use>
        </svg>
      </button>
      <div class="product-faq__content q-content">
        <p><?= $question->answer; ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<?php endif; ?>