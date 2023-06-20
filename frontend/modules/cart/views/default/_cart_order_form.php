<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<!-- <form class="order-form"> -->
<?php $form = ActiveForm::begin([
        'id' => 'order-form',
        'options' => [
            'class' => 'order-form'
        ],
    ]); ?>

<h3 class="order-form__title">
    <?= Yii::t('app', "Submit order"); ?>
</h3>

<input class="order-form__inp input-reset" type="name" placeholder="Ф.И.О.*">

<input class="order-form__inp input-reset" type="tel" placeholder="Телефон*">

<input class="order-form__inp input-reset" type="email" placeholder="Почта">

<?php // echo $form->field($order, 'comment')->textarea(['cols' => 20, 'rows' => 7, 'class' => "order-form__inp input-reset"]) ?>
<textarea class="order-form__inp input-reset" name="coment" id="" cols="20" rows="7"
    placeholder="Комментарий"></textarea>

    <div class="tabs order-tab" data-tabs="order-tab">

        <ul class="tabs__nav">
            <li class="tabs__nav-item">
                <button class="tabs__nav-btn" type="button">
                    <?= Yii::t('app', "Delivery Button Text"); ?>
                </button>
            </li>
            <li class="tabs__nav-item">
                <button class="tabs__nav-btn" type="button">
                    <?= Yii::t('app', "Pickup Button Text"); ?>
                </button>
            </li>
        </ul>

        <div class="tabs__content">
            <div class="tabs__panel">
                <textarea class="order-form__inp input-reset order-form__inp--tabs" name="coment" id="" cols="20"
                rows="4" placeholder="Адрес доставки*"></textarea>
                <p class="order-form__text">
                    <?= Yii::t('app', "Payment rules"); ?>
                </p>
            </div>
            <div class="tabs__panel">
                <a class="order-form__adress" target="_blank" href="<?= Yii::$app->configManager->getItemValue('contactMapLink'); ?>">
                    <?= Yii::$app->configManager->getItemValue('contactAddress'); ?>
                </a>
            </div>
        </div>
    </div>

    <p class="order-form__politics">
        <?= Yii::t('app', 'You are agree if submit'); ?> <?= Html::a(Yii::t('app', 'With privacy policy'), ['/privacy'], ['class' => "order-form__link"]); ?>
    </p>
    <?= Html::submitButton(Yii::t('app', "Checkout"), ['class' => "order-form__send btn-a btn-reset"])?>
<!-- </form> -->
<?php ActiveForm::end(); ?>
