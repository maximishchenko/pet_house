<?php

use backend\modules\management\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\management\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'users-form',
    ]); ?>


    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'role')->dropDownList(User::getRolesArray(), []) ?>
                <?= $form->field($model, 'newPassword')->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray(), []) ?>
                <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
            </div>
        </div>
    </div>






    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'users-form']); ?>