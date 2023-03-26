<?php

use backend\modules\content\models\Question;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

<?php $form = ActiveForm::begin([
        'id' => 'questions-form',
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
                <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'position')->dropdownList(Question::getPositionsArray(), []) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sort')->textInput() ?>
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'answer')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'questions-form']); ?>