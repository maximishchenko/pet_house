<?php

use frontend\models\Sections;
use yii\helpers\Html;

$this->title = $sections->getSectionName();
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container mb-l">
  <h1 class="section-headline"><?= Html::encode($sections->getSectionTitle()); ?></h1>
</div>

<div class="container mb-l">
  <div class="swiper catalog-categories">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a class="catalog-categories__el" href="#">
          <img class="catalog-categories__img" src="/img/catalog/1.png" alt="">
          <div class="catalog-categories__title">Витрины для шиншилл, дегу</div>
        </a>
      </div>
      <div class="swiper-slide">
        <a class="catalog-categories__el" href="#">
          <img class="catalog-categories__img" src="/img/catalog/2.png" alt="">
          <div class="catalog-categories__title">Витрины для кроликов</div>
        </a>
      </div>
      <div class="swiper-slide">
        <a class="catalog-categories__el" href="#">
          <img class="catalog-categories__img" src="/img/catalog/3.png" alt="">
          <div class="catalog-categories__title">Витрины для шиншилл, дегу</div>
        </a>
      </div>
      <div class="swiper-slide">
        <a class="catalog-categories__el" href="#">
          <img class="catalog-categories__img" src="/img/catalog/1.png" alt="">
          <div class="catalog-categories__title">Витрины для кроликов</div>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="catalog-bar mb-n">
  <div class="container">
    <div class="catalog-bar__wrapper">
      <div class="swiper receipts">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <button class="receipts__btn receipts__btn--filter s-btn" type="button">Все фильтры</button>
          </div>
          <div class="swiper-slide">
            <button class="receipts__btn s-btn" type="button">Только в наличии</button>
          </div>
          <div class="swiper-slide">
            <button class="receipts__btn s-btn" type="button">Витрины с керамикой</button>
          </div>
          <div class="swiper-slide">
            <button class="receipts__btn s-btn" type="button">Стандартные витрины</button>
          </div>
          <div class="swiper-slide">
            <button class="receipts__btn s-btn" type="button">Базовые витрины</button>
          </div>
        </div>
      </div>
      <div class="catalog-sort">
        <button class="catalog-sort__head btn-reset">
          <span class="catalog-sort__title">Сортировать:</span>
          <span class="catalog-sort__val">наименованию</span>
        </button>
        <ul class="catalog-sort__list list-reset">
          <li class="catalog-sort__el">Выводить сначала</li>
          <li class="catalog-sort__el">
            <button class="catalog-sort__item btn-reset" type="button">наименованию</button>
          </li>
          <li class="catalog-sort__el">
            <button class="catalog-sort__item btn-reset" type="button">популярные</button>
          </li>
          <li class="catalog-sort__el">
            <button class="catalog-sort__item btn-reset" type="button">дороже</button>
          </li>
          <li class="catalog-sort__el">
            <button class="catalog-sort__item btn-reset" type="button">дешевле</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<section class="catalog-thumbs mb-xxl">
  <div class="container">
    <div class="catalog-thumbs__wrapper">
      <div class="catalog-sidebar">

        <form action="" class="thumb-filter">
          <fieldset class="thumb-filter__area thumb-filter__area--switch">
            <span class="thumb-filter__title thumb-filter__title--switch">Только в наличии</span>
            <ul class="list-reset">
              <li>
                <label for="s1" class="switch">
                  <input id="s1" type="checkbox" class="switch">
                  <span class="slider round"></span>
                </label>
              </li>
            </ul>
          </fieldset>
          <fieldset class="thumb-filter__area">
            <legend class="thumb-filter__title">Категория витрины</legend>
            <ul class="list-reset">
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check1-inp" type="checkbox" id="c1" name="Витрины с керамикой">
                <label for="c1" class="thumb-filter__check1-label">
                  <span class="thumb-filter__check1-img" style="background-image: url('img/pop_сategories/1.jpg');"></span>
                  <span>Витрины с керамикой</span>
                </label>
              </li>
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check1-inp" type="checkbox" id="c2" name="Стандартные витрины">
                <label for="c2" class="thumb-filter__check1-label">
                  <span class="thumb-filter__check1-img" style="background-image: url('img/pop_сategories/3.jpg');"></span>
                  <span>Стандартные витрины</span>
                </label>
              </li>
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check1-inp" type="checkbox" id="c3" name="Базовые витрины">
                <label for="c3" class="thumb-filter__check1-label">
                  <span class="thumb-filter__check1-img" style="background-image: url('img/pop_сategories/2.jpg');"></span>
                  <span>Базовые витрины</span>
                </label>
              </li>
            </ul>
          </fieldset>
          <fieldset class="thumb-filter__area">
            <legend class="thumb-filter__title">Тип витрины</legend>
            <ul class="list-reset">
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check-inp" type="checkbox" id="t1" name="Прямая витрина">
                <label for="t1" class="thumb-filter__check-ic"><img src="img/p.svg" aria-hidden="true"><span class="thumb-filter__check-title">Прямая витрина</span></label>
              </li>
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check-inp" type="checkbox" id="t2" name="Двойная витрина">
                <label for="t2" class="thumb-filter__check-ic"><img src="img/u.svg" aria-hidden="true"><span class="thumb-filter__check-title">Двойная витрина</span></label>
              </li>
              <li class="thumb-filter__li">
                <input class="hide-inp thumb-filter__check-inp" type="checkbox" id="t3" name="Угловая витрина">
                <label for="t3" class="thumb-filter__check-ic"><img src="img/d.svg" aria-hidden="true"><span class="thumb-filter__check-title">Угловая витрина</span></label>
              </li>
            </ul>
          </fieldset>
          <fieldset class="thumb-filter__area">
            <legend class="thumb-filter__title">Высота витрины</legend>
            <ul class="list-reset thumb-filter__table">
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h7" name="height" value="Все" checked>
                <label class="thumb-filter__table-label" for="h7">Все</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h1" name="height" value="100 см">
                <label class="thumb-filter__table-label" for="h1">100 см</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h2" name="height" value="120 см">
                <label class="thumb-filter__table-label" for="h2">120 см</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h3" name="height" value="140 см">
                <label class="thumb-filter__table-label" for="h3">140 см</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h4" name="height" value="160 см">
                <label class="thumb-filter__table-label" for="h4">160 см</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h5" name="height" value="180 см">
                <label class="thumb-filter__table-label" for="h5">180 см</label>
              </li>
              <li class="thumb-filter__table-el">
                <input class="hide-inp thumb-filter__table-inp" type="radio" id="h6" name="height" value="200 см">
                <label class="thumb-filter__table-label" for="h6">200 см</label>
              </li>
            </ul>
          </fieldset>
          <div class="catalog-sidebar__controls">
            <button class="catalog-sidebar__btn btn-reset btn-a" type="button">Применить</button>
            <button class="catalog-sidebar__btn btn-reset btn-b" type="button">Сброить все</button>
          </div>
        </form>

      </div>
      <div class="catalog-thumbs__list">

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

        <a href="#" class="thumb-prod">
          <div class="thumb-prod__img-wrapper">
            <img class="thumb-prod__img" src="/img/cage.jpg" alt="">
          </div>
          <div class="thumb-prod__info">
            <span class="thumb-prod__price">20 000 ₽ <span class="thumb-prod__price-old">25 600 ₽</span></span>
            <h3 class="thumb-prod__title">U6 Угловая витрина</h3>
            <span class="thumb-prod__desc">
              В100 Ш60 Г40 см, Берёзовая фанера,
              шиншилла, дегу
            </span>
          </div>
        </a>

      </div>
    </div>
  </div>
</section>


<!-- Подписаться -->
<?php $this->beginBlock('subscribe'); ?>
<?= $this->render('//layouts/product/_subscribe', []); ?>
<?php $this->endBlock(); ?>

<!-- Вопросы и ответы -->
<?php $this->beginBlock('faq_bottom'); ?>
<?= $this->render('//layouts/product/_faq_bottom', []); ?>
<?php $this->endBlock(); ?>
