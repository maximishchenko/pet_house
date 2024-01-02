<?php

use backend\modules\content\models\Slider;
use backend\widgets\SingleImagePreviewWidget;
use yii\bootstrap4\ActiveForm;
use vova07\imperavi\Widget;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">


<?php $form = ActiveForm::begin([
        'id' => 'slider-form',
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
                <?= $form->field($model, 'sort')->textInput(['type' => 'number']) ?>
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'description')->widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 130,
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
            <div class="col-md-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'videoFile', ['template' => '{label}<br/> {input} {error}'])->fileInput() ?>
                <?php if(isset($model->video) && !empty($model->video)): ?>
                    <div class="row">
                        <?php
                        // SingleImagePreviewWidget::widget([
                        //     'id' => $model->id,
                        //     'filePath' => $model->getUrl(Slider::UPLOAD_PATH, $model->video),
                        //     'url' => 'delete-video',
                        //     'fancyboxGalleryName' => "SingleProductVideo",
                        // ]); 
                        ?>

                        <div class="col-md-3" id="1" style="display: inline-block;">
                            <li class="sortable__items">
                                <a data-caption="" data-fancybox="SingleProductVideo" href="<?= $model->getUrl(Slider::UPLOAD_PATH, $model->video); ?>">
                                    <video width="100%" src="<?= $model->getUrl(Slider::UPLOAD_PATH, $model->video); ?>">
                                </a>            
                            </li>
                            <?= Html::a('<i class="fa fa-trash"></i>', ['delete-video', 'id' => $model->id], ['class' => 'btn btn-danger img__delete__btn', 'data-confirm' => Yii::t('app', 'Do delete video answer'), 'data-method' => 'post']); ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'imageFile', ['template' => '{label}<br/> {input} {error}'])->fileInput() ?>
                <?php if(isset($model->image) && !empty($model->image)): ?>
                    <div class="row">
                        <?= SingleImagePreviewWidget::widget([
                            'id' => $model->id,
                            'filePath' => $model->getUrl(Slider::UPLOAD_PATH, $model->image),
                            'url' => 'delete-image',
                            'fancyboxGalleryName' => "SingleProductImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'slider-form']); ?>