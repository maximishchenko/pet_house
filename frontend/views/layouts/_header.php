<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<header class="header">
  <div class="container">
    <div class="header__wrapper">
      <a href="<?= Yii::$app->homeUrl; ?>" class="logo">
        <img class="logo__img" src="/img/logo.svg" alt="">
      </a>

      <nav class="nav" data-da=".mob-wrapper,768">
        <ul class="list-reset nav__list">
          <li class="nav__item">
            <?= Html::a(Yii::t('app', "Menu Item Rodent"), ['/chinchilles'], ['class' => 'nav__link']); ?>
          </li>
          <li class="nav__item">
            <?= Html::a(Yii::t('app', "Menu Item Dog"), ['/dogs'], ['class' => 'nav__link']); ?>
          </li>
          <li class="nav__item">
            <?= Html::a(Yii::t('app', "Menu Item Personal Order"), ['#'], ['class' => 'nav__link']); ?>
          </li>
          <li class="nav__item">
            <?= Html::a(Yii::t('app', 'Delivery and Payment'), ['/delivery'], ['class' => "nav__link"]); ?>
          </li>
        </ul>
      </nav>

      <?php if (!empty($settings->getItemValue('contactPhone'))) : ?>
        <a href="tel:<?= $settings->getItemValue('contactPhone'); ?>" class="header__phone" data-da=".mob-wrapper,768">
          <?= $settings->getItemValue('contactPhone'); ?>
        </a>
      <?php endif; ?>
      <!-- TODO Менять класс "bag-icon--acrive" -->
      <a href="<?= Url::toRoute("/cart") ?>" class="header__bag bag-icon bag-icon--acrive">
        <span class="cart-val">2</span>
        <svg class="bag-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path class="bag-fill" d="M3.93366 7.92875C3.97104 7.40545 4.40648 7 4.93112 7H19.0689C19.5935 7 20.029 7.40545 20.0663 7.92875L20.9235 19.9288C20.9648 20.5076 20.5064 21 19.926 21H4.07398C3.49363 21 3.03517 20.5076 3.07652 19.9288L3.93366 7.92875Z" stroke-linejoin="round" />
          <path d="M8 11V6.21053C8 3.88512 9.79086 2 12 2C14.2091 2 16 3.88512 16 6.21053V11" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
        
      <button class="burger-btn btn-reset" type="button">
        <svg id="burger-btn__icon" class="ham hamRotate ham1" viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active')">
          <path class="line top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
          <path class="line middle " d="m 30,50 h 40" />
          <path class="line bottom daw" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
        </svg>
      </button>

    </div>

    <div class="mob-wrapper"></div>
  </div>
</header>

<div class="mob-bar">
  <button id="btn-catalog" class="mob-bar__el btn-reset">
    <svg class="mob-bar__icon">
      <use xlink:href="/img/sprite.svg#cat"></use>
    </svg>
    <?= Yii::t('app', "Menu Item Catalog"); ?>
  </button>
  <a class="mob-bar__el" href="<?= Url::toRoute('/delivery'); ?>">
    <svg class="mob-bar__icon">
      <use xlink:href="/img/sprite.svg#loc"></use>
    </svg>
    <?= Yii::t('app', 'Delivery'); ?>
  </a>
  <button class="mob-bar__el btn-reset mob-bar__chat">
    <svg class="mob-bar__icon">
      <use xlink:href="/img/sprite.svg#mes"></use>
    </svg>
    <?= Yii::t('app', 'Chat'); ?>
  </button>
  <a class="mob-bar__el" href="<?= Url::toRoute('/cart'); ?>">
    <svg class="mob-bar__icon">
      <use xlink:href="/img/sprite.svg#bag"></use>
    </svg>
    <?= Yii::t('app', 'Cart'); ?>
  </a>
</div>

<div class="mob-catalog">
  <div class="mob-catalog__head">
    <span class="modal-title">
      <?= Yii::t('app', "Menu Item Catalog"); ?>
    </span>
    <button class="mob-catalog__close btn-reset" type="button">
      <svg>
        <use xlink:href="/img/sprite.svg#close"></use>
      </svg>
    </button>
  </div>
  <div class="mob-catalog__wrapper">

    <div class="mob-catalog__inner">
      <a class="mob-catalog__link" href="#">
        <span class="mob-catalog__img" style="background-image: url('img/c_1.jpg');"></span>
        <?= Yii::t('app', "Menu Item Rodent"); ?>
      </a>
      <a class="mob-catalog__link" href="#">
        <span class="mob-catalog__img" style="background-image: url('img/c_2.jpg');"></span>
        <?= Yii::t('app', "Menu Item Dog"); ?>
      </a>
      <a class="mob-catalog__link" href="#">
        <span class="mob-catalog__img" style="background-image: url('img/c_3.jpg');"></span>
        <?= Yii::t('app', "Menu Item Cat"); ?>
      </a>
      <a class="mob-catalog__link" href="#">
        <span class="mob-catalog__img" style="background-image: url('img/c_4.jpg');"></span>
        <?= Yii::t('app', "Menu Item Bird"); ?>
      </a>
    </div>

    <section class="pop-categories mt-xl mb-m">
      <div class="container">
        <h2 class="section-headline centered">Популярные категории</h2>
      </div>
      <div class="swiper pop-categories__slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/1.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Витрины для шиншил</h3>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/2.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Вольеры для собак</h3>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/3.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Когтеточки для кошек</h3>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/1.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Когтеточки для кошек</h3>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/2.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Вольеры для собак</h3>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="#" class="pop-categories__link">
              <img src="/img/pop_сategories/3.jpg" alt="" class="pop-categories__img">
              <h3 class="pop-categories__title">Когтеточки для кошек</h3>
            </a>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
