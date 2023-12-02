<?php

namespace console\controllers;

use backend\modules\catalog\models\abstracts\PropertySize;
use backend\modules\catalog\models\root\Property;
use yii\console\Controller;

class UpdateSizeController extends Controller
{
      public function actionIndex()
      {
            $sizes = Property::find()->where(['item_type' => 'size'])->all();
            foreach ($sizes as $size) {
                  $size->height_value = explode("x", $size->name)[0];
                  $size->width_value = explode("x", $size->name)[1];
                  $size->depth_value = explode("x", $size->name)[2];
                  $size->save();
                  echo $size->name . " " . $size->height_value . PHP_EOL;
            }
      }
}