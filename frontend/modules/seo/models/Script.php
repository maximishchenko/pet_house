<?php

namespace frontend\modules\seo\models;

use backend\modules\seo\models\Script as backendScripts;
use common\models\Status;

class Script extends backendScripts
{
    public static function getScripts($position)
    {
        if(in_array($position, array_keys(static::getScriptPositionsArray()))) {
            $scripts = self::find()
                ->where(['status' => Status::STATUS_ACTIVE, 'position' => $position])
                ->all();
            foreach ($scripts as $script) {
                print $script->code;
            }
        }
        return false;
    }
}