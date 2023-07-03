<?php

use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\root\Product;
use backend\widgets\SingleImagePreviewWidget;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\catalog\models\RodentProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<?= $this->render('//layouts/_product_tabs', ['model' => $model]); ?>

<div class="rodent-product-form">
    <?php $form = ActiveForm::begin([
        'id' => 'rodent-product-form',
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
                    ])->hint(Yii::t('app', "Rodent Showcase Name hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'category_id')->dropDownList(
                        $model->getCategoriesItems(),
                        $model->getCategoriesParams()
                    )->hint(Yii::t('app', "Rodent Showcase Category hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'slug')->textInput([
                        'disabled' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Slug hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'type_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE),
                        // $model->getPropertiesItems($this->item_type),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE)
                    )->hint(Yii::t('app', "Rodent Showcase Type hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'size_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE)
                    )->hint(Yii::t('app', "Rodent Showcase Size hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'material_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL)
                    )->hint(Yii::t('app', "Rodent Showcase Material hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'color_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR)
                    )->hint(Yii::t('app', "Rodent Showcase Color hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'engraving_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_ENGRAVING),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_ENGRAVING)
                    )->hint(Yii::t('app', "Rodent Showcase Engraving hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'wall_id')->dropDownList(
                        $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL),
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL)
                    )->hint(Yii::t('app', "Rodent Showcase Wall hint")); ?>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'sort')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'discount')->textInput() ?>
                <?= $form->field($model, 'view_count')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'status')->checkbox() ?>
                <?= $form->field($model, 'is_available')->checkbox() ?>
                <?= $form->field($model, 'is_constructor_blocked')->checkbox() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'productAttributesArray')->checkboxList($model->getAttributesCheckboxListItems(), ['class' => 'checkbox__group']) ?>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'informationItemsArray')->checkboxList($model->getInformationCheckboxListItems(), ['class' => 'checkbox__group']) ?>
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
                            'filePath' => $model->getUrl(Product::UPLOAD_PATH, $model->image),
                            'url' => 'delete-image',
                            'fancyboxGalleryName' => "SingleProductImage",
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <!-- TODO перенести drag-n-drop сортировку в клетки -->
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

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'rodent-product-form']); ?>