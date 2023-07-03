<?php

use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\root\Product;
use backend\widgets\SingleImagePreviewWidget;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

?>

<div class="rodent-product-form">
    <?php $form = ActiveForm::begin([
        'id' => 'rodent-accessory-form',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => ['template' => "{label}\n{input}\n{hint}\n{error}"],
        'encodeErrorSummary' => false,
        'errorSummaryCssClass' => 'alert alert-danger',
        'errorCssClass'=>'text-danger',
    ]); ?>
    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

    <div class="jumbotron">
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Accessory Name hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'material_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL)
                    )->hint(Yii::t('app', "Rodent Showcase Material hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'sort')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'slug')->textInput([
                        'disabled' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Accessory Slug hint")); ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'status')->checkbox() ?>
            </div>
        </div>
    </div>
    
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'imagesFiles[]', ['template' => '{label}<br/> {input} {error}'])->fileInput(['multiple' => true]) ?>
                <?php if(isset($model->productImages) && !empty($model->productImages)):?>
                <ul style="margin: 0; padding: 0;">
                    <div id="sortable" class="row" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl('/catalog/rodent-showcase-product/save-image-sort'); ?>">
                        <?php foreach ($model->productImages as $k => $img): ?>
                            <?php 
                            echo SingleImagePreviewWidget::widget([
                                'id' => $img->id,
                                'filePath' => $img->getUrl(Product::UPLOAD_PATH, $img->image),
                                'url' => 'delete-images',
                                'fancyboxGalleryName' => "MultipleProductImage",
                            ]); 
                            ?>
                        <?php endforeach; ?>
                    </div>
                </ul>
                <?= Html::a(Yii::t('app', 'Delete All Images'), ['delete-all-images', 'id' => $model->id], ["data-method" => "post", "data-confirm" => Yii::t("app", "Do delete all images answer"), 'style' => 'margin-top: 3rem; padding-top: 3rem;']); ?>
                <?php endif; ?>
            </div>

        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'rodent-accessory-form']); ?>