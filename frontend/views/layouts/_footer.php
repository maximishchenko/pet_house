<?php
use yii\helpers\Html;
?>

<footer class="footer pt-xxl mt-xxl">
  <div class="container">
    <div class="footer__wrapper">
      <div class="footer__contacts">
        <h2 class="footer__title">
          <?= Yii::t('app', 'Footer Contacts Block'); ?>
        </h2>
        <div class="contacts-footer">
          <!-- Телефон -->
          <?php if (!empty($settings->getItemValue('contactPhone'))): ?>
              <a href="tel:<?= $settings->getItemValue('contactPhone'); ?>" class="contacts-footer__link"><span class="contacts-footer__title"><?= Yii::t('app', 'Footer Phone'); ?></span><?= $settings->getItemValue('contactPhone'); ?></a>
          <?php endif; ?>
          <!-- Email -->
          <?php if (!empty($settings->getItemValue('contactEmail'))): ?>
            <a href="mailto://<?= $settings->getItemValue('contactEmail'); ?>" class="contacts-footer__link"><span class="contacts-footer__title"><?= Yii::t('app', 'Footer Email'); ?></span><?= $settings->getItemValue('contactEmail'); ?></a>
          <?php endif; ?>
          <!-- Адрес и ссылка на карту -->
          <?php if (!empty($settings->getItemValue('contactAddress')) && !empty($settings->getItemValue('contactMapLink'))): ?>
            <a href="<?= $settings->getItemValue('contactMapLink'); ?>" class="contacts-footer__link"><span class="contacts-footer__title"><?= Yii::t('app', 'Footer Address'); ?></span><?= $settings->getItemValue('contactAddress'); ?></a>
          <?php endif; ?>
        </div>
  
        <!-- Соц. сети -->
        <ul class="social list-reset">
          <?php if (!empty($settings->getItemValue('contactInstagram'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactInstagram'); ?>" target="_blank" class="social__link social__link--fb"
              aria-label="<?= Yii::t('app', "We are in IG"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#in"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactWhatsapp'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactWhatsapp'); ?>" target="_blank" class="social__link social__link--vk"
              aria-label="<?= Yii::t('app', "We are in WA"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#wt"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactTelegram'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactTelegram'); ?>" target="_blank" class="social__link social__link--tw"
              aria-label="<?= Yii::t('app', "We are in Telegram"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#tl"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactVk'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactVk'); ?>" target="_blank" class="social__link social__link--fb"
              aria-label="<?= Yii::t('app', "We are in VK"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#vk"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactAvito'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactAvito'); ?>" target="_blank" class="social__link social__link--vk"
              aria-label="<?= Yii::t('app', "We are in Avito"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#av"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactLiveMaster'))): ?>
          <li class="social__item">
            <a href="<?= $settings->getItemValue('contactLiveMaster'); ?>" target="_blank" class="social__link social__link--tw"
              aria-label="<?= Yii::t('app', "We are in LiveMaster"); ?>">
              <svg>
                <use xlink:href="/img/sprite.svg#lm"></use>
              </svg>
            </a>
          </li>
          <?php endif; ?>
        </ul>

        <div class="footer__messages">
          <?php if (!empty($settings->getItemValue('contactWhatsapp'))): ?>
          <a href="<?= $settings->getItemValue('contactWhatsapp'); ?>" class="footer__watsapp">
            <svg class="message-wt">
              <use xlink:href="/img/sprite.svg#wt"></use>
            </svg> 
            <?= Yii::t('app', 'Send WhatsApp Message'); ?>
          </a>
          <?php endif; ?>
          <?php if (!empty($settings->getItemValue('contactTelegram'))): ?>
          <a href="<?= $settings->getItemValue('contactTelegram'); ?>" class="footer__telegram"><svg class="message-tl">
              <use xlink:href="/img/sprite.svg#tl"></use>
            </svg>
            <?= Yii::t('app', 'Send Telegram Message'); ?>
          </a>
          <?php endif; ?>
        </div>

      </div>
      <div class="footer__vk">
        <h2 class="footer__title mb-s">Мы в Вконтакте</h2>
        <a href="#" class="vk-grid">
          <div class="vk-grid__a">
            <img loading="lazy" src="/img/grid/1.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__b">
            <img loading="lazy" src="/img/grid/7.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__c">
            <img loading="lazy" src="/img/grid/4.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__d">
            <img loading="lazy" src="/img/grid/6.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__e">
            <img loading="lazy" src="/img/grid/10.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__f">
            <img loading="lazy" src="/img/grid/11.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__g">
            <img loading="lazy" src="/img/grid/3.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
          <div class="vk-grid__h">
            <img loading="lazy" src="/img/grid/9.jpg" class="image" width="400" height="400" alt="Контакт">
          </div>
        </a>
      </div>
    </div>
    <div class="footer__end mt-n">
      <span class="footer__copyrights">© 2016 — <?= date('Y'); ?> <?= Yii::$app->name; ?></span>
      <a href="#" class="footer__requisites">Реквизиты</a>
      <?= Html::a(Yii::t('app', 'Privacy'), '/privacy', ['class' => 'footer__privacy']); ?>
    </div>
  </div>
</footer>
