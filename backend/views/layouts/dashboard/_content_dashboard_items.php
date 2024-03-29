<?php

use common\models\User;
use yii\helpers\Url;
if(Yii::$app->user->can(User::ROLE_ADMIN)):
?>
<h2>
    <?= Yii::t('app', "Content Module Items"); ?>
</h2><hr>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Sliders'),
            'text' => Yii::t('app', 'Sliders Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/content/slider'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Questions'),
            'text' => Yii::t('app', 'Questions Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/content/question'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Information'),
            'text' => Yii::t('app', 'Information Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/content/information'])
        ]) ?>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <?= \hail812\adminlte\widgets\SmallBox::widget([
            'title' => Yii::t('app', 'Review'),
            'text' => Yii::t('app', 'Review Edit'),
            'icon' => 'fas fa-cog',
            'theme' => 'warning',
            'linkText' => Yii::t('app', 'GO_LINK'),
            'linkUrl' => Url::to(['/content/review'])
        ]) ?>
    </div>
</div>
<?php endif; ?>