<section class="hero mb-n">
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="hero__slide hero__slide-des">
                    <div class="hero__content">
                        <div class="hero__headline-wrapper">
                            <h2 class="section-headline">Доставка по всей России</h2>
                            <p class="hero__desk">Сложно сказать, почему реплицированные с зарубежных источников</p>
                        </div>
                        <div class="hero__btn-wrapper">
                            <a href="#" class="btn-b hero__btn">Купить</a>
                        </div>
                    </div>
                    <video class="hero__video" src="video/v5.mp4" type="video/mp4" autoplay muted loop></video>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="hero__slide hero__slide-des">
                    <div class="hero__content">
                        <div class="hero__headline-wrapper">
                            <h2 class="section-headline">Супер скидки</h2>
                            <p class="hero__desk">Сложно сказать, почему реплицированные с зарубежных источников</p>
                        </div>
                        <div class="hero__btn-wrapper">
                            <a href="#" class="btn-b hero__btn">Витрины для шиншил</a>
                        </div>
                    </div>
                    <video class="hero__video" src="video/v1_2.mp4" type="video/mp4" autoplay muted loop></video>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="categories mb-xxl mt-n">
    <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('img/ic_ch.svg');"></div>
        <h3 class="categories__title">Грызуны</h3>
    </a>
    <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('img/ic_d.svg');"></div>
        <h3 class="categories__title">Собаки</h3>
    </a>
    <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('img/ic_c.svg');"></div>
        <h3 class="categories__title">Кошки</h3>
    </a>
    <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('img/ic_b.svg');"></div>
        <h3 class="categories__title">Птицы</h3>
    </a>
</section>


<!-- Есть в наличии -->
<?= $this->render('//layouts/product/_item_slider', ['title' => Yii::t('app', "Available Products")]); ?>


<section class="media-info mb-xxl">
    <div class="media-info__head">
        <h2 class="section-headline centered">С теплом и заботой о тех, кого любим</h2>
        <p class="media-info__text centered mb-m">
            Господа, постоянный количественный рост
            и сфера нашей активности позволяет выполнить
        </p>
    </div>
    <div class="scroll-wrapper">
        <img src="/img/touch_ic.svg" class="touch_ic" alt="">
        <div class="media-info__gallary" data-aos="zoom-out-up" data-aos-offset="-200" data-aos-anchor-placement="top-bottom">

            <div class="b-grid">
                <a href="img/grid/1.jpg" class="b-grid__a" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/1.jpg" alt="">
                </a>
                <a href="img/grid/18.jpg" class="b-grid__b" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/18.jpg" alt="">
                </a>
                <a href="video/2.mp4" class="b-grid__c" data-fancybox="gallery__grid">
                    <video class="b-grid__video b-grid__video--v" poster="video/2.jpg" autoplay playsinline muted loop>
                        <source src="video/2.mp4" type="video/mp4">
                    </video>
                </a>
                <a href="img/grid/13.jpg" class="b-grid__d" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/13.jpg" alt="">
                </a>
                <a href="img/grid/11.jpg" class="b-grid__f" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/11.jpg" alt="">
                </a>
                <a href="img/grid/10.jpg" class="b-grid__g" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/10.jpg" alt="" loading="lazy">
                </a>
                <a href="img/grid/17.jpg" class="b-grid__h" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/17.jpg" alt="">
                </a>
                <a href="img/grid/7.jpg" class="b-grid__q" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/7.jpg" alt="">
                </a>
                <a href="img/grid/16.jpg" class="b-grid__s" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/16.jpg" alt="">
                </a>
                <a href="img/grid/4.jpg" class="b-grid__r" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/4.jpg" alt="">
                </a>
                <a href="img/grid/9.jpg" class="b-grid__t" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/9.jpg" alt="">
                </a>
            </div>
            <div class="b-grid">
                <a href="img/grid/5.jpg" class="b-grid__a" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/5.jpg" alt="">
                </a>
                <a href="video/1.mp4" class="b-grid__b" data-fancybox="gallery__grid">
                    <video class="b-grid__video" poster="video/1.jpg" autoplay playsinline muted loop>
                        <source src="video/1.mp4" type="video/mp4">
                    </video>
                </a>
                <a href="img/grid/8.jpg" class="b-grid__c" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/8.jpg" alt="">
                </a>
                <a href="img/grid/9.jpg" class="b-grid__d" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/9.jpg" alt="">
                </a>
                <a href="img/grid/4.jpg" class="b-grid__f" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/4.jpg" alt="">
                </a>
                <a href="img/grid/15.jpg" class="b-grid__g" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/15.jpg" alt="">
                </a>
                <a href="img/grid/13.jpg" class="b-grid__h" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/13.jpg" alt="">
                </a>
                <a href="img/grid/14.jpg" class="b-grid__q" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/14.jpg" alt="">
                </a>
                <a href="img/grid/3.jpg" class="b-grid__s" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/3.jpg" alt="">
                </a>
                <a href="img/grid/2.jpg" class="b-grid__r" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/2.jpg" alt="">
                </a>
                <a href="img/grid/7.jpg" class="b-grid__t" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/7.jpg" alt="">
                </a>
            </div>
            <div class="b-grid">
                <a href="img/grid/1.jpg" class="b-grid__a" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/1.jpg" alt="">
                </a>
                <a href="img/grid/18.jpg" class="b-grid__b" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/18.jpg" alt="">
                </a>
                <a href="video/3.mp4" class="b-grid__c" data-fancybox="gallery__grid">
                    <video class="b-grid__video b-grid__video--v" poster="video/3.jpg" autoplay playsinline muted loop>
                        <source src="video/3.mp4" type="video/mp4">
                    </video>
                </a>
                <a href="img/grid/13.jpg" class="b-grid__d" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/13.jpg" alt="">
                </a>
                <a href="img/grid/11.jpg" class="b-grid__f" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/11.jpg" alt="">
                </a>
                <a href="img/grid/10.jpg" class="b-grid__g" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/10.jpg" alt="">
                </a>
                <a href="img/grid/17.jpg" class="b-grid__h" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/17.jpg" alt="">
                </a>
                <a href="img/grid/7.jpg" class="b-grid__q" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/7.jpg" alt="">
                </a>
                <a href="img/grid/16.jpg" class="b-grid__s" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/16.jpg" alt="">
                </a>
                <a href="img/grid/4.jpg" class="b-grid__r" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/4.jpg" alt="">
                </a>
                <a href="img/grid/9.jpg" class="b-grid__t" data-fancybox="gallery__grid">
                    <img class="b-grid__img" decoding="async" src="img/grid_min/9.jpg" alt="">
                </a>
            </div>
        </div>
    </div>
    <div class="media-info__text-content mt-xxl mb-xxl">
        <div class="media-info__text-row">
            <h4 class="media-info__subtitle">Материалы</h4>
            <p class="media-info__text">Древесина дуба, структура которой гармонично сочетается с эмалью, стеклом и
                разноцветными принтами - неизменный
            </p>
        </div>
        <div class="media-info__text-row">
            <h4 class="media-info__subtitle">Функциональность</h4>
            <p class="media-info__text">Качественные подшипники в беговом колесе избавят вас от шума, что особенно актуально
                ночью, когда грызуны
                активны</p>
        </div>

    </div>

    <div class="tiker tiker--f">
        <div class="tiker__wrapper tiker__wrapper--f">
            <span class="tiker__item tiker__item--f media-info__tiker">Качество</span>
            <span class="tiker__item tiker__item--f media-info__tiker media-info__tiker--stroke">Функциональность</span>
            <span class="tiker__item tiker__item--f media-info__tiker">Безопасность</span>
            <span class="tiker__item tiker__item--f media-info__tiker media-info__tiker--stroke">Функциональность</span>
            <span class="tiker__item tiker__item--f media-info__tiker">Безопасность</span>
            <span class="tiker__item tiker__item--f media-info__tiker media-info__tiker--stroke">Качество</span>
        </div>
    </div>
    <div class="tiker tiker--s mb-xxl">
        <div class="tiker__wrapper tiker__wrapper--s">
            <span class="tiker__item tiker__item--s media-info__tiker media-info__tiker--stroke">Функциональность</span>
            <span class="tiker__item tiker__item--s media-info__tiker">Качество</span>
            <span class="tiker__item tiker__item--s media-info__tiker media-info__tiker--stroke">Функциональность</span>
            <span class="tiker__item tiker__item--s media-info__tiker">Безопасность</span>
            <span class="tiker__item tiker__item--s media-info__tiker media-info__tiker--stroke">Качество</span>
        </div>
    </div>
    <div class="meadia-reviews">
        <div class="container">
            <div class="meadia-reviews__wrapper">
                <div class="meadia-reviews__el" data-aos-offset="-500" data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">
                    <p class="meadia-reviews__text">Пришлось немного попривыкать,
                        но наш Борька справился! Уже начал грызть полки, но ничего, мы знаем, где взять новые, если что ) Думаю,
                        обратимся к вам снова!</p>
                    <div class="meadia-reviews__row">
                        <div class="meadia-reviews__photo" style="background-image: url(img/avatars/3.jpg);"></div>
                        <div class="meadia-reviews__autor">
                            <span class="meadia-reviews__name">Елена</span>
                            <span class="meadia-reviews__date">25 января</span>
                        </div>
                    </div>
                </div>
                <div class="meadia-reviews__el" data-aos="fade-up" data-aos-offset="-500" data-aos-duration="2200" data-aos-anchor-placement="top-bottom">
                    <p class="meadia-reviews__text">Пришлось немного попривыкать,
                        но наш Борька справился! Уже начал грызть полки, но ничего, мы знаем, где взять новые, если что ) Думаю,
                        обратимся к вам снова!</p>
                    <div class="meadia-reviews__row">
                        <div class="meadia-reviews__photo" style="background-image: url(img/avatars/1.jpg);"></div>
                        <div class="meadia-reviews__autor">
                            <span class="meadia-reviews__name">Елена</span>
                            <span class="meadia-reviews__date">25 января</span>
                        </div>
                    </div>
                </div>
                <div class="meadia-reviews__el" data-aos="fade-up" data-aos-offset="-500" data-aos-duration="2400" data-aos-anchor-placement="top-bottom">
                    <p class="meadia-reviews__text">Пришлось немного попривыкать,
                        но наш Борька справился! Уже начал грызть полки, но ничего, мы знаем, где взять новые, если что ) Думаю,
                        обратимся к вам снова!</p>
                    <div class="meadia-reviews__row">
                        <div class="meadia-reviews__photo" style="background-image: url(img/avatars/2.jpg);"></div>
                        <div class="meadia-reviews__autor">
                            <span class="meadia-reviews__name">Елена</span>
                            <span class="meadia-reviews__date">25 января</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Есть в наличии -->
<?= $this->render('//layouts/product/_item_slider', ['title' => Yii::t('app', "Top Products")]); ?>

<!-- Подписаться -->
<?= $this->render('//layouts/template/_subscribe'); ?>

<!-- Вопросы и ответы -->
<?= $this->render('//layouts/product/_faq_bottom'); ?>
