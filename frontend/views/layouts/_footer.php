<?php

use yii\helpers\Url;

?>
<footer class="footer pt-xxl mt-xxl">
  <div class="container">
    <div class="footer__wrapper">
      <div class="footer__row footer__border">
        <div class="footer__contacts">
          <span class="footer__contacts-title">Есть вопросы?</span>
          <?php if (Yii::$app->configManager->getItemValue('contactPhone')): ?>
          <a href="tel:<?= Yii::$app->configManager->getItemValue('contactPhone'); ?>" class="footer__phone"><?= Yii::$app->configManager->getItemValue('contactPhone'); ?></a>
          <?php endif; ?>
          <?php if (Yii::$app->configManager->getItemValue('contactEmail')): ?>
          <a href="mailto://<?= Yii::$app->configManager->getItemValue('contactEmail'); ?>" class="footer__mail">
            <svg class="footer__mail-ic">
              <use xlink:href="/img/sprite.svg#mail"></use>
            </svg>
            <?= Yii::$app->configManager->getItemValue('contactEmail'); ?>
          </a>
          <?php endif; ?>
        </div>
        <div class="footer__col footer__messangers-wrap">
          <div class="footer__messangers">
            <?php if(!empty(Yii::$app->configManager->getItemValue('contactWhatsapp'))): ?>
            <a href="<?= Yii::$app->configManager->getItemValue('contactWhatsapp'); ?>" class="footer__btn-wt">
              <svg>
                <use xlink:href="/img/sprite.svg#wt"></use>
              </svg>
              Написать в Watsapp
            </a>
            <?php endif; ?>
            <?php if(!empty(Yii::$app->configManager->getItemValue('contactTelegram'))): ?>
            <a href="<?= Yii::$app->configManager->getItemValue('contactTelegram'); ?>" class="footer__btn-tl">
              <svg>
                <use xlink:href="/img/sprite.svg#tl"></use>
              </svg>
              Написать в Telegram
            </a>
            <?php endif; ?>
          </div>
          <a href="#header" class="footer__up">
            <svg class="footer__up-ic">
              <use xlink:href="/img/sprite.svg#arrow_up"></use>
            </svg>
          </a>
        </div>
      </div>
      <div class="footer__row mt-xxl footer__row-links">
        <div class="footer__address">

          <div class="address-wrapper">
            <div class="flex-column">
              <span class="footer__list-title">Адрес</span>
              <a href="<?= Yii::$app->configManager->getItemValue('contactMapLink'); ?>" class="footer__link">
                <?= Yii::$app->configManager->getItemValue('contactAddress'); ?>
              </a>
            </div>
          </div>

          <ul class="social list-reset">
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactInstagram'); ?>" target="_blank" class="social__link social__link--fb" aria-label="Наша страничка в Инстаграмм">
                <svg>
                  <use xlink:href="/img/sprite.svg#in"></use>
                </svg>
              </a></li>
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactWhatsapp'); ?>" target="_blank" class="social__link social__link--vk" aria-label="Связаться в WhatsApp">
                <svg>
                  <use xlink:href="/img/sprite.svg#wt"></use>
                </svg>
              </a></li>
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactTelegram'); ?>" target="_blank" class="social__link social__link--tw" aria-label="Связаться в Telegram">
                <svg>
                  <use xlink:href="/img/sprite.svg#tl"></use>
                </svg>
              </a></li>
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactVk'); ?>" target="_blank" class="social__link social__link--fb" aria-label="Наша страничка в ВК">
                <svg>
                  <use xlink:href="/img/sprite.svg#vk"></use>
                </svg>
              </a></li>
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactAvito'); ?>" target="_blank" class="social__link social__link--vk" aria-label="Мы на Авито">
                <svg>
                  <use xlink:href="/img/sprite.svg#av"></use>
                </svg>
              </a></li>
            <li class="social__item"><a href="<?= Yii::$app->configManager->getItemValue('contactLiveMaster'); ?>" target="_blank" class="social__link social__link--tw" aria-label="LiveMaster">
                <svg>
                  <use xlink:href="/img/sprite.svg#lm"></use>
                </svg>
              </a></li>
          </ul>
          <span class="instagram-desk">
            Деятельность компании Meta запрещена на территории РФ
          </span>
        </div>
        <div class="footer__list-links">
          <ul class="list-reset footer__list">
            <li class="footer__list-title">Каталог</li>
            <li class="footer__list-item">
              <a href="<?= Url::toRoute('/chinchilles'); ?>" class="footer__link">Шиншиллы</a>
            </li>
            <li class="footer__list-item">
              <a href="<?= Url::toRoute('/dogs'); ?>" class="footer__link">Собаки</a>
            </li>
            <!-- <li class="footer__list-item">
              <a href="#" class="footer__link">Кошки</a>
            </li>
            <li class="footer__list-item">
              <a href="#" class="footer__link">Птицы</a>
            </li> -->
            <!-- TODO запуск модального окна -->
            <li class="footer__list-item">
              <a href="#" class="footer__link">Персональный заказ</a>
            </li>
          </ul>
          <ul class="list-reset footer__list">
            <li class="footer__list-title">Информация для покупателей</li>
            <li class="footer__list-item">
              <a href="<?= Url::toRoute('/delivery'); ?>" class="footer__link">Доставка и оплата</a>
            </li>
            <!-- TODO запуск модального окна -->
            <li class="footer__list-item">
              <button class="footer__link btn-reset requisites-open-btn">Реквизиты</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer__fin">
      <span>© <?= Yii::$app->configManager->getItemValue('companyStartYear'); ?> – <?= date('Y'); ?> домпитомца.рф</span>
      <button class="btn-reset requisites-open-btn">Реквизиты</button>
      <a href="<?= Url::toRoute('/privacy'); ?>">Политика конфидециальности</a>
    </div>
  </div>
</footer>

<div class="sidebar-bottom">
  <div class="sidebar-bottom__wrapper">
    <div class="sidebar-bottom__haed">
      <span class="sidebar-bottom__title">Реквизиты</span>
      <button class="sidebar-bottom__btn-close btn-reset">
        <svg>
          <use xlink:href="/img/sprite.svg#close"></use>
        </svg>
      </button>
    </div>

    <div class="sidebar-bottom__body">
      <ul class="list-reset requisites">
        <?= Yii::$app->configManager->getItemValue('contactRequisites'); ?>
      </ul>
    </div>
  </div>
  <div class="sidebar-bottom__bg"></div>
</div>

<div class="cookie-modal cookie_notice cookie-modal--hide" style="display: flex;">
  <span class="cookie-modal__desc">Продолжая использовать наш сайт, вы даете согласие
    <a href="<?= Url::toRoute('/privacy'); ?>" class="cookie-modal__link">на обработку файлов cookie</a>,
    которые обеспечивают правильную работу сайта.</span>
  <button type="button" class="cookie-modal__btn btn-reset" id="cookie_close">ok</button>
</div>