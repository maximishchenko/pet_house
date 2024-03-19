<?php

use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\CategoryUpload;
use backend\modules\catalog\models\root\Property;
use backend\widgets\SingleImagePreviewWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentShowcaseCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rodent-showcase-category-form">

<?php $form = ActiveForm::begin([
        'id' => 'rodent-showcase-category-form',
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
                <?= $form->field($model, 'slug')->textInput(['disabled' => true]) ?>
                <?= $form->field($model, 'sort')->textInput() ?>
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'font_color')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'text_color')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'badge_color')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
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
                            'filePath' => $model->getUrl(Category::UPLOAD_PATH, $model->image),
                            'url' => 'delete-image',
                            'fancyboxGalleryName' => "SinglePropertyImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'files[]', ['template' => '{label}<br/> {input} {error}'])->fileInput(['multiple' => true]) ?>
                <?php if(isset($model->uploads) && !empty($model->uploads)):?>
                <ul style="margin: 0; padding: 0;">
                    <div id="sortable" class="row" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl('/catalog/rodent-showcase-product/save-image-sort'); ?>">
                        <?php foreach ($model->uploads as $k => $img): ?>
                            <?php 
                            echo SingleImagePreviewWidget::widget([
                                'id' => $img->id,
                                'filePath' => $img->getUrl(CategoryUpload::UPLOAD_PATH, $img->file_path),
                                'url' => 'delete-file',
                                'fancyboxGalleryName' => "MultipleProductImage",
                            ]); 
                            ?>
                        <?php endforeach; ?>
                    </div>
                </ul>
                <?= Html::a(Yii::t('app', 'Delete All Images'), ['delete-all-files', 'id' => $model->id], ["data-method" => "post", "data-confirm" => Yii::t("app", "Do delete all files answer"), 'style' => 'margin-top: 3rem; padding-top: 3rem;']); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'rodent-showcase-category-form']); ?>