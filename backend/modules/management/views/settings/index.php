<?php

use backend\modules\management\models\Setting;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'MANAGEMENT_MODULE'), 'url' => ['/management']];
$this->params['breadcrumbs'][] = $this->title;
// Yii::$app->params['settings']['phone']
?>

<div class="settings-index">

    <div class="container">
        
    
        <?php $form = ActiveForm::begin([
            'id' => 'settings-form'
        ]); ?>

        <ul class="nav nav-tabs" id="settingsTabs" role="tablist">

            <?php foreach (array_keys(Setting::getTabsArray()) as $k => $tab): ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>-tab" data-toggle="tab" href="#<?= $tab; ?>" role="tab" aria-controls="<?= $tab; ?>" aria-selected="true">
                        <?= Setting::getTabsArray()[$tab]; ?>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>

        <div class="tab-content" id="settingsTabsContent" style="margin-top: 50px;">

            <?php foreach (array_keys(Setting::getTabsArray()) as $k => $tab): ?>
                <div class="tab-pane fade show <?= ($k == 0) ? 'active' : null; ?>" id="<?= $tab; ?>" role="tabpanel" aria-labelledby="<?= $tab; ?>-tab">
                    <div class="row">
                    <?php foreach ($settings as $setting):  ?>
                        <?php if ($setting->tab == $tab): ?>
                        
                            <div class="col-md-4">


                            <?php
                                            
                                if ($setting->field_type == Setting::FIELD_TYPE_STR) {
                                    echo $form->field($setting, 'value')->textInput(['name' => 'value['. $setting->id .']'])->label($setting->name)->hint(Yii::t('app', "Use param {param}", ['param' => "Yii::\$app->params['settings']['" . $setting->key . "']"]));
                                } elseif ($setting->field_type == Setting::FIELD_TYPE_NUMBER) {
                                    echo $form->field($setting, 'value')->textInput(['name' => 'value['. $setting->id .']', 'type' => 'number'])->label($setting->name)->hint(Yii::t('app', "Use param {param}", ['param' => "Yii::\$app->params['settings']['" . $setting->key . "']"]));
                                } elseif ($setting->field_type == Setting::FIELD_TYPE_TEXT) {
                                    echo $form->field($setting, 'value')->textarea(['name' => 'value['. $setting->id .']', 'rows' => 6])->label($setting->name)->hint(Yii::t('app', "Use param {param}", ['param' => "Yii::\$app->params['settings']['" . $setting->key . "']"]));
                                } elseif ($setting->field_type == Setting::FIELD_TYPE_CHECKBOX) {
                                    echo $form->field($setting, 'value')->checkbox(['name' => 'value['. $setting->id .']'])->label($setting->name)->hint(Yii::t('app', "Use param {param}", ['param' => "Yii::\$app->params['settings']['" . $setting->key . "']"]));
                                } else {
                                    echo $form->field($setting, 'value')->textInput(['name' => 'value['. $setting->id .']'])->label($setting->name)->hint(Yii::t('app', "Use param {param}", ['param' => "Yii::\$app->params['settings']['" . $setting->key . "']"]));
                                }    
                            ?>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?= $this->render('//layouts/forms/_buttons', ['formId' => 'settings-form']); ?>