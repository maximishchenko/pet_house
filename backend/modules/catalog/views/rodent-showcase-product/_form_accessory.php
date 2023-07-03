<?php

use backend\modules\catalog\models\RodentShowcaseAccessory;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

?>


<div class="rodent-product-form">
    <?php $form = ActiveForm::begin([
        'id' => 'rodent-product-accessory-form',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => ['template' => "{label}\n{input}\n{error}"],
        'encodeErrorSummary' => false,
        'errorSummaryCssClass' => 'alert alert-danger',
        'errorCssClass'=>'text-danger',
    ]); ?>
    <?= $form->errorSummary($accessoryModel, ['class' => 'alert alert-danger']); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?php
                    $accessories = RodentShowcaseAccessory::find()->all();
                    $accessoriesItems = ArrayHelper::map($accessories, 'id', 'name');
                ?>

                <?= $form->field($accessoryModel, 'accessory_id')->dropDownList($accessoriesItems, ['prompt' => ' --- ']); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($accessoryModel, 'count')->textInput([
                        'maxlength' => true
                    ]); ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'rodent-product-accessory-form']); ?>