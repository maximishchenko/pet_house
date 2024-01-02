<?php

use backend\modules\catalog\models\root\Product;
use backend\modules\content\models\Review;
use backend\modules\content\models\Slider;
use yii\helpers\Url;

?>
<?php if (isset($sliders) && !empty($sliders)): ?>
<section class="hero mb-n">
    <div class="swiper hero-slider">
        <div class="swiper-wrapper">
            
            <?php foreach($sliders as $slider): ?>
                <?php if (isset($slider->video) && !empty($slider->video)):?>
                    <div class="swiper-slide">
                        <div class="hero__slide hero__slide-des">
                            <div class="hero__content">
                                <div class="hero__headline-wrapper">
                                    <h2 class="section-headline"><?= $slider->name; ?></h2>
                                    <p class="hero__desk">
                                        <?= $slider->description; ?>
                                    </p>
                                </div>
                                <div class="hero__btn-wrapper">
                                    <a href="<?= $slider->url; ?>" class="btn-b hero__btn">Купить</a>
                                </div>
                            </div>

                            <video class="hero__video" src="<?= "/" . Slider::UPLOAD_PATH . $slider->video; ?>" type="video/mp4" autoplay muted loop></video>

                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            
        </div>
    </div>
</section>
<?php endif; ?>


<section class="categories mb-xxl mt-n">
    <a href="<?= Url::toRoute('/chinchilles'); ?>" class="categories__el">
        <div class="categories__img" style="background-image: url('/img/ic_ch.svg');"></div>
        <h3 class="categories__title">Грызуны</h3>
    </a>
    <a href="<?= Url::toRoute('/dogs'); ?>" class="categories__el">
        <div class="categories__img" style="background-image: url('/img/ic_d.svg');"></div>
        <h3 class="categories__title">Собаки</h3>
    </a>
    <!-- <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('/img/ic_c.svg');"></div>
        <h3 class="categories__title">Кошки</h3>
    </a>
    <a href="#" class="categories__el">
        <div class="categories__img" style="background-image: url('/img/ic_b.svg');"></div>
        <h3 class="categories__title">Птицы</h3>
    </a> -->
</section>


<!-- Есть в наличии -->
<?= $this->render('//layouts/product/_item_slider', ['title' => Yii::t('app', "Available Products"), 'products' => Product::getAvailableProducts()]); ?>


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

                <?php if (isset($reviews) && !empty($reviews)) : ?>

                    <?php foreach ($reviews as $review) : ?>

                        <div class="meadia-reviews__el" data-aos-offset="-500" data-aos="fade-up" data-aos-duration="2000" data-aos-anchor-placement="top-bottom">
                            <p class="meadia-reviews__text">
                                <?= $review->text; ?>
                            </p>
                            <div class="meadia-reviews__row">
                                <div class="meadia-reviews__photo" style="background-image: url(<?= '/' . Review::UPLOAD_PATH . $review->avatar; ?>);"></div>
                                <div class="meadia-reviews__autor">
                                    <span class="meadia-reviews__name">
                                        <?= $review->name; ?>
                                    </span>
                                    <span class="meadia-reviews__date">
                                        <?= $review->created_at; ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- Есть в наличии -->
<?php // echo $this->render('//layouts/product/_item_slider', ['title' => Yii::t('app', "Top Products")]); 
?>

<!-- Подписаться -->
<?php $this->beginBlock('subscribe'); ?>
<?= $this->render('//layouts/template/_subscribe'); ?>
<?php $this->endBlock(); ?>