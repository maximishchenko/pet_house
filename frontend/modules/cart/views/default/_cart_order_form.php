<?php

use frontend\modules\cart\models\Cart;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin([
    'id' => 'order-form',
    'action' => ['order'],
    'class' => 'order-form',
    'method' => 'post',
    'enableAjaxValidation'   => false,
    'enableClientValidation' => false,
    'validateOnBlur'         => false,
    'validateOnType'         => false,
    'validateOnChange'       => false,
    'validateOnSubmit'       => false,
    'enableClientScript'     => false,
    'options' => [
        'class' => (Cart::getTotalCount() > 0) ? 'order-form order-form--cart' : 'order-form order-form--cart order-form--dis',
        'autocomplete' => 'off',
    ],
]); ?>

<h3 class="order-form__title">
    <?= Yii::t('app', "Submit order"); ?>
</h3>

<?= $form->field($order, 'name', ['template' => '{input}'])->textInput(['class' => "order-form__inp input-reset", 'placeholder' => Yii::t('app', 'Order Name')]); ?>

<?= $form->field($order, 'phone', ['template' => '{input}'])->textInput(['type' => 'tel', 'class' => "order-form__inp input-reset phone-valid", "pattern" => "^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?", 'placeholder' => Yii::t('app', 'Order Phone')]); ?>

<?= $form->field($order, 'email', ['template' => '{input}'])->textInput(['type' => 'email', 'class' => "order-form__inp input-reset", 'placeholder' => Yii::t('app', 'Order Email')]); ?>

<?= $form->field($order, 'comment', ['template' => '{input}'])->textarea(['cols' => 20, 'rows' => 7, 'class' => "order-form__inp input-reset", 'placeholder' => Yii::t('app', 'Order Comment')]) ?>


<?= $form->field($order, 'spam_check', ['template' => '{input}'])->textInput(['id' => 'spam_check', 'hidden' => true]); ?>

<div class="tabs order-tab" data-tabs="order-tab">
    <ul class="tabs__nav">
        <li class="tabs__nav-item">
            <?= Html::button(Yii::t('app', "Delivery Button Text"), ['class' => "tabs__nav-btn", 'type' => 'button', 'data-delivery' => 'Доставка']); ?>
        </li>
        <li class="tabs__nav-item">
            <?= Html::button(Yii::t('app', "Pickup Button Text"), ['class' => "tabs__nav-btn", 'type' => 'button', 'data-delivery' => 'Самовывоз']) ?>
        </li>
    </ul>
    <div class="tabs__content">
        <div class="tabs__panel">
            <?= $form->field($order, 'delivery_address', ['template' => '{input}'])->textarea(['cols' => 20, 'rows' => 4, 'class' => "order-form__inp input-reset order-form__inp--tabs", 'placeholder' => Yii::t('app', 'Order Delivery Address')]) ?>
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
    <?= $form->field($order, 'delivery_type', ['template' => '{input}'])->textInput(['id' => 'orderDelivery', 'class' => "order-form__inp input-reset visually-hidden", 'value' => 'Доставка', 'placeholder' => Yii::t('app', 'Order Delivery Type')]); ?>
</div>

<p class="order-form__politics">
    <?= Yii::t('app', 'You are agree if submit'); ?> <?= Html::a(Yii::t('app', 'With privacy policy'), ['/privacy'], ['class' => "order-form__link"]); ?>
</p>
<?= Html::submitButton(Yii::t('app', "Checkout"), ['class' => "order-form__send btn-a btn-reset", 'onclick' => "document.getElementById('spam_check').value = 'nospam';"]); ?>

<?php ActiveForm::end(); ?>