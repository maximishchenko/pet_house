<?php

namespace backend\modules\catalog\models;

use backend\modules\catalog\models\abstracts\PropertySize;
use Yii;

/**
 * Размеры витрин для грызунов
 */
class RodentShowcaseSize extends PropertySize
{

      public function beforeSave($insert)
      {
          if (parent::beforeSave($insert)) {
              if ($this->validate()) {
                  $thirdPartOfPrice = $this->price / 3;
                  $this->height_price = $thirdPartOfPrice;
                  $this->width_price = $thirdPartOfPrice;
                  $this->depth_price = $thirdPartOfPrice;
              } else {
                  foreach ($this->getErrors() as $key => $value) {
                      Yii::debug($key.': '.$value[0]);
                  }
              }
              return true;
          }
          return false;
      }
}