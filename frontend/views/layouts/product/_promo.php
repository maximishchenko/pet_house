<?php
use backend\modules\content\models\Information;
?>
<div class="promo-block mb-xxl pt-m">
    <div class="promo-block__head">
      <h2 class="product-headline centered">
        Для кого подходят витрины Дом Грызунов?
      </h2>
      <p class="promo-block__text centered">
        Наши витрины разработаны совместно с заводчиками
        и питомниками шиншилл и дегу с учетом анатомических
        особенностей крупных грызунов.</p>
    </div>

    <?php foreach($model->informations as $promoKey => $promoPostItem): ?>

    <?php if ($promoKey % 2): ?>
      <div class="product-info">
    <?php else: ?>
      <div class="product-info product-info--inv">
    <?php endif; ?>
      <div class="product-info__col-text">
        <h4 class="product-info__headline">
          <?= $promoPostItem->name; ?>
        </h4>
        <p class="product-info__text">
          <?= $promoPostItem->description; ?>
        </p>
      </div>
      <div class="product-info__col-video">
        <video class="product-info__video" src="<?= "/" . Information::UPLOAD_PATH . $promoPostItem->video; ?>" autoplay playsinline muted loop></video>
      </div>
    </div>

    <?php endforeach;?>
</div>