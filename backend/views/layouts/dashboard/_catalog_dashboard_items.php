<?php

use common\models\User;
use yii\helpers\Url;
if(Yii::$app->user->can(User::ROLE_ADMIN)):
?>

<h2>
    <?= Yii::t('app', "Showcases for rodents"); ?>
</h2><hr>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Sizes'),
            'text' => Yii::t('app', 'Sizes Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-size'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Types'),
            'text' => Yii::t('app', 'Types Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-type'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Materials'),
            'text' => Yii::t('app', 'Materials Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-material'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Engravings'),
            'text' => Yii::t('app', 'Engravings Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-engraving'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Walls'),
            'text' => Yii::t('app', 'Walls Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-wall'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Colors'),
            'text' => Yii::t('app', 'Colors Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-color'])
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Attributes'),
            'text' => Yii::t('app', 'Attributes Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'info',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-attribute'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Categories'),
            'text' => Yii::t('app', 'Categories Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'primary',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-category'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Groups'),
            'text' => Yii::t('app', 'Groups Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'primary',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-group'])
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Rodent Accessory'),
            'text' => Yii::t('app', 'Rodent Accessory Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'success',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-accessory'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Rodent Products'),
            'text' => Yii::t('app', 'Rodent Products Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'success',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/rodent-showcase-product'])
        ]) ?>
    </div>
</div>

<h2>
    <?= Yii::t('app', "Cages for dogs"); ?>
</h2><hr>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Sizes'),
            'text' => Yii::t('app', 'Sizes Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-size'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Types'),
            'text' => Yii::t('app', 'Types Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-type'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Materials'),
            'text' => Yii::t('app', 'Materials Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-material'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Engravings'),
            'text' => Yii::t('app', 'Engravings Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-engraving'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Walls'),
            'text' => Yii::t('app', 'Walls Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-wall'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Colors'),
            'text' => Yii::t('app', 'Colors Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-color'])
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Attributes'),
            'text' => Yii::t('app', 'Attributes Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'info',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-attribute'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Categories'),
            'text' => Yii::t('app', 'Categories Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'primary',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-category'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Groups'),
            'text' => Yii::t('app', 'Groups Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'primary',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-group'])
        ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Dog Cage Accessory'),
            'text' => Yii::t('app', 'Dog Cage Accessory Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'success',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-accessory'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Dog Cage Products'),
            'text' => Yii::t('app', 'Dog Cage Products Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'success',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/catalog/dog-cage-product'])
        ]) ?>
    </div>
</div>


<!-- </div> -->
<?php endif; ?>