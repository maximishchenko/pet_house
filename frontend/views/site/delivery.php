<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Delivery and Payment');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-head">
    <div class="container">
        <div class="page-head__wrapper delivery-page-head__wrapper">
            <h1 class="section-headline">
                Доставка и оплата </h1>
        </div>
    </div>
</div>

<div class="delivery">
    <div class="container">
        <div class="delivery__wrapper">
            <div class="delivery__col">
                <h2 class="delivery__title">Главное, что нужно знать о доставке</h2>
                <p class="delivery__text">Наши клетки доставляются в собранном виде</p>
                <div class="delivery__faq-wrapper">
                    <div class="main-faq__el q-el">
                        <button class="btn-reset main-faq__btn q-btn">
                            <span class="main-faq__headline">
                                Самовывоз </span>
                            <svg class="main-faq__icon q-icon">
                                <use xlink:href="/img/sprite.svg#plus"></use>
                            </svg>
                        </button>
                        <div class="main-faq__content q-content">
                            <p>Вы можете самостоятельно забрать клетку у нас на производстве по адресу: Московская область, Солнечногорский район, пос. Поварово. Оплата производится наличными или банковской картой на месте.</p>
                        </div>
                    </div>
                    <div class="main-faq__el q-el">
                        <button class="btn-reset main-faq__btn q-btn">
                            <span class="main-faq__headline">
                                Доставка по Москве и Московской области </span>
                            <svg class="main-faq__icon q-icon">
                                <use xlink:href="/img/sprite.svg#plus"></use>
                            </svg>
                        </button>
                        <div class="main-faq__content q-content">
                            <p>Мы доставим клетку до Вашего подъезда. Точную дату и временной интервал доставки Вам сообщит наш менеджер по телефону. Стоимость доставки рассчитывается с учетом места Вашего проживания. Оплата производится наличными или банковской картой курьеру.</p>
                            <p> Если с вашей стороны будет помощник-мужчина, то наш водитель поможет поднять клетку до квартиры; если нет, то сумма за подъем обговаривается на месте, исходя из условий.</p>
                        </div>
                    </div>
                    <div class="main-faq__el q-el">
                        <button class="btn-reset main-faq__btn q-btn">
                            <span class="main-faq__headline">
                                Доставка по России и СНГ</span>
                            <svg class="main-faq__icon q-icon">
                                <use xlink:href="/img/sprite.svg#plus"></use>
                            </svg>
                        </button>
                        <div class="main-faq__content q-content">
                            <p>Мы доставим клетку в любой город России и СНГ с помощью транспортных компаний. Мы доверяем таким логистическим компаниям, как «Деловые линии», «Байкал Сервис».</p>
                            <p>Мы обязательно страхуем груз и делаем дополнительную упаковку и обрешетку для сохранности груза. Стекла аккуратно упаковываются и на время доставки присоединяются к задней стенке витрины.</p>
                            <p> Наш менеджер сориентирует Вас по стоимости и срокам доставки для Вашего города. После оформления груза в терминале, мы сообщаем Вам номер накладной для отслеживания, присылаем фото готовой клетки и реквизиты для оплаты заказа. Услуги доставки оплачиваются отдельно при получении заказа. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="delivery__col">
                <h2 class="delivery__title">Оплата</h2>
                <ul class="delivery__list">
                    <li class="delivery__list-item">Москва и Московская область – полная оплата при получении наличными или банковской картой</li>
                    <li class="delivery__list-item">Регионы России и СНГ – полная оплата после отправки груза в терминале транспортной компании</li>
                </ul>
            </div>
        </div>
    </div>
</div>