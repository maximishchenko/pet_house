<?php

use common\models\User;
use yii\helpers\Url;
if(Yii::$app->user->can(User::ROLE_ADMIN)):
?>
<div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::t('app', 'ORDERS'),
                'text' => Yii::t('app', 'ORDERS Edit'),
                'icon' => 'fas fa-cog',
                'theme' => 'danger',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/catalog/order'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::t('app', 'SETTINGS'),
                'text' => Yii::t('app', 'SETTINGS Edit'),
                'icon' => 'fas fa-cog',
                'theme' => 'danger',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/management/settings'])
            ]) ?>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => Yii::t('app', 'USERS'),
                'text' => Yii::t('app', 'USERS Edit'),
                'icon' => 'fas fa-users',
                'theme' => 'danger',
                'linkText' => Yii::t('app', 'GO_LINK'),
                'linkUrl' => Url::to(['/management/users'])
            ]) ?>
        </div>
</div>


<!-- </div> -->
<?php endif; ?>