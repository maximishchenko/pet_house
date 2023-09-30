<?php

use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\DogCageSize */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dog-cage-size-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dog-cage-size-form',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => ['template' => "{label}\n{input}\n{hint}\n{error}"],
        'encodeErrorSummary' => false,
        'errorSummaryCssClass' => 'alert alert-danger',
        'errorCssClass'=>'text-danger',
    ]); ?>    

    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'height')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'width')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'depth')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sort')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'dog-cage-size-form']); ?>
