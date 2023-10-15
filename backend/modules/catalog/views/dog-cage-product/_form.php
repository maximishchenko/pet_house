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
                        $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE)
                    )->hint(Yii::t('app', "Rodent Showcase Type hint")); ?>
            </div>
            <!-- <div class="col-md-4"> -->
                <!-- <div class="form-group"> -->
                    <!-- <label for="millingexample-coating_id"> -->
                        <?php // $model->getAttributeLabel('size_id'); ?>
                    <!-- </label> -->
                <?php
                // echo Select2::widget([
                //         'model' => $model,
                //         'attribute' => 'size_id',
                //         'data' => $model->getSizesItems(),
                //         'options' => [
                //             'placeholder' => '', 'autocomplete' => 'off'
                //         ],
                //         'pluginOptions' => [
                //             'allowClear' => true
                //         ],
                //     ]);
                ?>
                <!-- </div> -->
                <?php 
                // echo $form->field($model, 'size_id')->dropDownList(
                //         $model->getPropertiesItems(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE),
                //         $model->getPropertiesParams(PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE)
                //     )->hint(Yii::t('app', "Rodent Showcase Size hint")); 
                ?>
            <!-- </div> -->
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
            <div class="col-md-4">
                <?= $form->field($model, 'height')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Height hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'width')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Width hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'depth')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Depth hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'min_height')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Min Height hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'min_width')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Min Width hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'min_depth')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Min Depth hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'max_height')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Max Height hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'max_width')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Max Width hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'max_depth')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Max Depth hint")); ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'height_price')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Height Price hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'width_price')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Width Price hint")); ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'depth_price')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Depth Price hint")); ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'step')->textInput([
                        'maxlength' => true
                    ])->hint(Yii::t('app', "Rodent Showcase Step hint")); ?>
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
                <?= $form->field($model, 'imagesFiles[]', ['template' => '{label}<br/> {input} {error}'])->fileInput(['multiple' => true]) ?>
                <?php if(isset($model->productImages) && !empty($model->productImages)):?>
                <ul style="margin: 0; padding: 0;">
                    <div id="sortable" class="row" data-url="<?= Yii::$app->urlManager->createAbsoluteUrl('/catalog/dog-cage-product/save-image-sort'); ?>">
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