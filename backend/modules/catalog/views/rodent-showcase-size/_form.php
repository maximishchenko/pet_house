<?php

use backend\modules\catalog\models\root\Property;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseSize */
/* @var $form yii\widgets\ActiveForm */

// echo $model->test();
?>
<div class="rodent-showcase-size-form">

    <?php $form = ActiveForm::begin([
        'id' => 'rodent-showcase-size-form',
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
    
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
            <?= $form->field($model, 'imageFile', ['template' => '{label}<br/> {input} {error}'])->fileInput() ?>
                <?php if(isset($model->image) && !empty($model->image)): ?>
                    <div class="row">
                        <?= SingleImagePreviewWidget::widget([
                            'id' => $model->id,
                            'filePath' => $model->getUrl(Property::UPLOAD_PATH, $model->image),
                            'url' => 'delete-image',
                            'fancyboxGalleryName' => "SinglePropertyImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
<?= $this->render('//layouts/forms/_buttons', ['formId' => 'rodent-showcase-size-form']); ?>
