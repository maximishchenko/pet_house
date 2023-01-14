<?php

namespace backend\modules\management\controllers;

use backend\modules\management\models\Setting;
use Yii;

class SettingsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $settings = Setting::find()->orderBy(["field_type" => "DESC"])->all();

        if ($this->request->isPost) {


            $post = \Yii::$app->request->post()['value'];

            foreach($post as $id => $value) {
                $setting = Setting::findOne($id);
                Setting::getDb()->transaction(function($db) use ($setting, $value) {
                    $setting->value = $value;
                    $setting->save();
                });
            }
            Yii::$app->session->setFlash('success', Yii::t('app', 'Settings changed'));
            return $this->refresh();
        } else {
            return $this->render('index', [
                'settings' => $settings
            ]);
        }
     
    }

}
