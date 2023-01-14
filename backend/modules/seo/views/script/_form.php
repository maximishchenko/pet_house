<?php

use backend\modules\seo\models\Script;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\seo\models\Script */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="script-form">
    <div class="container">

    <?php $form = ActiveForm::begin([
        'id' => 'script-form',
    ]); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'sort')->textInput() ?>

                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'position')->dropDownList(Script::getScriptPositionsArray(), []) ?>
                <?= $form->field($model, 'code')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'script-form']); ?>