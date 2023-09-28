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
                <p class="delivery__text">Наши витрины доставляются в собранном виде. Стекла аккуратно упаковываются и на время доставки присоединяются к задней стенке витрины. Это обеспечивает безопасность доставки. Мы предлагаем несколько вариантов доставки:</p>
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
                            <p>Вы можете самостоятельно забрать витрину у нас на производстве по адресу: Московская область, Солнечногорский район, пос. Поварово. Это абсолютно бесплатно. Оплата витрины производится наличными или банковской картой на месте.</p>
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
                            <p>Мы доставим витрину до Вашего подъезда. Точный срок доставки Вам сообщит наш менеджер по телефону. Водитель поможет поднять витрину на ваш этаж. Стоимость доставки рассчитывается с учетом места Вашего проживания. Услуги доставки оплачиваются отдельно при получении заказа. Наш менеджер обязательно предупредит Вас об этом по телефону. Оплата производится наличными или банковской картой курьеру.</p>
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
                            <p>Мы доставим витрину в любой город России и СНГ с помощью транспортных компаний. Мы доверяем таким логистическим компаниям, как «Деловые линии», «Байкал Сервис». По Вашему желанию отправим заказ другой удобной транспортной компанией. Наш менеджер сориентирует Вас по стоимости и срокам доставки для Вашего города. Перед отправкой мы отправляем Вам фото готовой витрины. Далее вы вносите предоплату в размере 50% стоимости витрины. Наш менеджер предупредит Вас об этом. После оформления груза в терминале, мы сообщаем Вам номер накладной для отслеживания отправления. После получения заказа вы оплачиваете оставшуюся часть суммы. Услуги доставки оплачиваются отдельно при получении заказа. Наш менеджер обязательно предупредит Вас об этом по телефону.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="delivery__col">
                <h2 class="delivery__title">Оплата</h2>
                <ul class="delivery__list       ">
                    <li class="delivery__list-item">Мы работаем без предоплаты с клиентами из Москвы и Московской области. Вы оплачиваете заказ при получении или банковской картой курьеру.</li>
                    <li class="delivery__list-item">С клиентами из других регионов России и СНГ мы работаем по предоплате, которая составляет 50%.</li>
                    <li class="delivery__list-item">Доставка по Москве и Московской области, а также по СНГ оплачивается отдельно при получении заказа курьеру.</li>
                    <li class="delivery__list-item">Наш менеджер обязательно предупредит Вас об этом по телефону.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
