<?php

use backend\modules\content\models\Review;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap4\ActiveForm;
use vova07\imperavi\Widget;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin([
        'id' => 'reviews-form',
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
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                <?php
                 echo '<label class="control-label">' . $model->getAttributeLabel('created_at') . '</label>';
                 echo DatePicker::widget([
                     'model' => $model,
                     'attribute' => 'created_at',
                     'options' => ['placeholder' => $model->getAttributeLabel('created_at')],
                     'pluginOptions' => [
                         'autoclose' => true,
                         'format' => 'dd.mm.yyyy'
                     ]
                 ]); 
                ?>
                <?= $form->field($model, 'sort')->textInput() ?>
                <?= $form->field($model, 'status')->checkbox() ?>
                <?= $form->field($model, 'is_favorite')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'text')->widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 300,
                        'plugins' => [
                            'clips',
                            'fullscreen',
                        ],
                        'clips' => [
                            ['Lorem ipsum...', 'Lorem...'],
                            ['red', '<span class="label-red">red</span>'],
                            ['green', '<span class="label-green">green</span>'],
                            ['blue', '<span class="label-blue">blue</span>'],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
    
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'imageFile', ['template' => '{label}<br/> {input} {error}'])->fileInput() ?>
                <?php if(isset($model->image) && !empty($model->image)): ?>
                    <div class="row">
                        <?= SingleImagePreviewWidget::widget([
                            'id' => $model->id,
                            'filePath' => $model->getUrl(Review::UPLOAD_PATH, $model->image),
                            'url' => 'delete-image',
                            'fancyboxGalleryName' => "SingleProductImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'avatarFile', ['template' => '{label}<br/> {input} {error}'])->fileInput() ?>
                <?php if(isset($model->avatar) && !empty($model->avatar)): ?>
                    <div class="row">
                        <?= SingleImagePreviewWidget::widget([
                            'id' => $model->id,
                            'filePath' => $model->getUrl(Review::UPLOAD_PATH, $model->avatar),
                            'url' => 'delete-avatar',
                            'fancyboxGalleryName' => "SingleProductImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'reviews-form']); ?>