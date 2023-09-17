<?php

use common\components\Word;
use frontend\modules\cart\models\Cart;
use yii\helpers\Url;

?>
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
              <img class="cart-sidebar-el__img cart-sidebar-img-item" src="" alt="">
            </div>
            <div class="cart-sidebar-el__inner">
                <span class="cart-sidebar-el__title cart-sidebar-title-item">
                    <!-- Прямая витрина Р2B -->
                </span>
                <div class="cart-sidebar-el__price-wrapper">
                    <div class="counter">
                        <button class="btn-reset counter__btn-min"></button>
                        <span class="counter__val cart-sidebar-count-item">
                            <!-- 2 -->
                        </span>
                        <button class="btn-reset counter__btn-plus"></button>
                    </div>
                    <span class="cart-sidebar-el__price">
                        <span class="cart-sidebar-price-item">
                            <!-- 40 000 -->
                        </span> ₽
                    </span>
                </div>
            </div>
          </div>
        </div>
        <div class="cart-sidebar__price-wrapper">
          <span class="cart-sidebar__price">
            <span class="cart-sidebar__price-sub">
              Итого <span class="cart-sidebar-totalcount-item"></span> на сумму
            </span>
            <span class="cart-sidebar-totalprice-item">  
            </span> ₽
          </span>
        </div>

        <a href="<?= Url::toRoute('/cart'); ?>" class="cart-sidebar__link btn-a">
          Оформитиь заказ
        </a>

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