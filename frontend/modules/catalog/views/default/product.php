<?php

$this->title = "Карточка товара";
$this->params['breadcrumbs'][] = ['label' => "Шиншиллы", 'url' => ['/chinchilles'], 'class' => 'breadcrumbs__link'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-mob"></div>
<div class="container">
  <section class="product">
    <div class="product__col">

      <!-- Галлерея -->
      <?= $this->render('//layouts/product/_gallery', ['model' => $model]); ?>
      <div class="product__optional">
        <!-- Аксессуары -->
        <?= $this->render('//layouts/product/_accessories', []); ?>
        <!-- Промо -->
        <?= $this->render('//layouts/product/_promo', ['model' => $model]); ?>
        <!-- Отзывы -->
        <?= $this->render('//layouts/template/_faq', []); ?>
        <!-- Вопросы и ответы -->
        <?= $this->render('//layouts/product/_review', []); ?>
      </div>
    </div>
    <!-- Конструктор -->
    <?= $this->render('//layouts/product/_sidebar', ['model' => $model]); ?>
  </section>
</div>

<!-- Хиты продаж -->
<?= $this->render('//layouts/_top_sales', ['title' => "Хиты продаж", 'model' => $model]); ?>


<!-- Подписаться -->
<?php $this->beginBlock('subscribe'); ?>
<?= $this->render('//layouts/template/_subscribe', []); ?>
<?php $this->endBlock(); ?>

<!-- Вопросы и ответы -->
<?php $this->beginBlock('faq_bottom'); ?>
<?= $this->render('//layouts/product/_faq_bottom', []); ?>
<?php $this->endBlock(); ?>

<div class="cart-sidebar">
  <div class="cart-sidebar__wrapper">
    <div class="cart-sidebar__inner">
      <div class="cart-sidebar__header">
        <span>Товар в корзине</span>
        <button class="cart-sidebar__btn-close btn-reset">
          <svg>
            <use xlink:href="/img/sprite.svg#close"></use>
          </svg>
        </button>
      </div>
      <div class="cart-sidebar__body">
        <div class="cart-sidebar__prod-wrapper">
          <div class="cart-sidebar-el">
            <div class="cart-sidebar-el__img-wrapper">
              <img class="cart-sidebar-el__img" src="/img/accessories/a1.jpg" alt="">
            </div>
            <div class="cart-sidebar-el__inner">
              <span class="cart-sidebar-el__title">Прямая витрина Р2B</span>
              <div class="cart-sidebar-el__price-wrapper">
                <div class="counter">
                  <button class="btn-reset counter__btn-min"></button>
                  <span class="counter__val">1</span>
                  <button class="btn-reset counter__btn-plus"></button>
                </div>
                <span class="cart-sidebar-el__price">40 000 ₽</span>
              </div>
            </div>
          </div>
        </div>
        <div class="cart-sidebar__price-wrapper">
          <span class="cart-sidebar__price"><span class="cart-sidebar__price-sub">Итого 1 товар на сумму</span>  15 000 ₽</span>
        </div>

        <a href="#" class="cart-sidebar__link btn-a">Оформитиь заказ</a>

           <div class="add-accessories mt-xxl">
          <h2 class="">С этим товаром покупают</h2>
          <div class="swiper add-accessories__swiper swiper-initialized swiper-horizontal swiper-backface-hidden">
            <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
              <div class="swiper-slide swiper-slide-active">
                <div class="card-accessories">
                  <div class="card-accessories__img-wrapper">
                    <img class="card-accessories__img" src="/img/accessories/a1.jpg" alt="">
                  </div>
                  <div class="card-accessories__text-wrapper">
                    <span class="card-accessories__price">3 200 ₽</span>
                    <a href="#">
                      <h3 class="card-accessories__name">Сенница Белый-Бежевый</h3>
                    </a>
                    <button class="btn-reset card-accessories__btn" type="button">В&nbsp;корзину</button>
                  </div>
                </div>
              </div>
              <div class="swiper-slide swiper-slide-next">
                <div class="card-accessories">
                  <div class="card-accessories__img-wrapper">
                    <img class="card-accessories__img" src="/img/accessories/a1.jpg" alt="">
                  </div>
                  <div class="card-accessories__text-wrapper">
                    <span class="card-accessories__price">3 200 ₽</span>
                    <a href="#">
                      <h3 class="card-accessories__name">Белый-Бежевый</h3>
                    </a>
                    <button class="btn-reset card-accessories__btn" type="button">В&nbsp;корзину</button>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-accessories">
                  <div class="card-accessories__img-wrapper">
                    <img class="card-accessories__img" src="/img/accessories/a1.jpg" alt="">
                  </div>
                  <div class="card-accessories__text-wrapper">
                    <span class="card-accessories__price">3 200 ₽</span>
                    <a href="#">
                      <h3 class="card-accessories__name">Сенница Белый-Бежевый</h3>
                    </a>
                    <button class="btn-reset card-accessories__btn" type="button">В&nbsp;корзину</button>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-accessories">
                  <div class="card-accessories__img-wrapper">
                    <img class="card-accessories__img" src="/img/accessories/a1.jpg" alt="">
                  </div>
                  <div class="card-accessories__text-wrapper">
                    <span class="card-accessories__price">3 200 ₽</span>
                    <a href="#">
                      <h3 class="card-accessories__name">Белый-Бежевый</h3>
                    </a>
                    <button class="btn-reset card-accessories__btn" type="button">В&nbsp;корзину</button>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="card-accessories">
                  <div class="card-accessories__img-wrapper">
                    <img class="card-accessories__img" src="/img/accessories/a1.jpg" alt="">
                  </div>
                  <div class="card-accessories__text-wrapper">
                    <span class="card-accessories__price">3 200 ₽</span>
                    <a href="#">
                      <h3 class="card-accessories__name">Сенница Белый-Бежевый</h3>
                    </a>
                    <button class="btn-reset card-accessories__btn" type="button">В&nbsp;корзину</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-button-prev add-accessories__btn-prev swiper-button-disabled"></div>
            <div class="swiper-button-next add-accessories__btn-next"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="cart-sidebar__bg"></div>
</div>