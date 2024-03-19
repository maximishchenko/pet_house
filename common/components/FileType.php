<?php

namespace common\components;

use Yii;

class FileType
{
      const TYPE_VIDEO = 'video';

      const TYPE_IMAGE = 'image';

      public static function getFileTypesArray()
      {
            return [
                  self::TYPE_IMAGE => Yii::t('app', "File type image"),
                  self::TYPE_VIDEO => Yii::t('app', "File type video"),
            ];
      }
}