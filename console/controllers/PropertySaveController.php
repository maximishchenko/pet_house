<?php

namespace console\controllers;

use backend\modules\catalog\models\root\Property;
use yii\console\Controller;
use yii\helpers\Console;
 
class PropertySaveController extends Controller
{
    public function actionIndex()
    {
        $properties = Property::find()->all();
        foreach ($properties as $property) {
            $property->save();
            $this->stdout('ID ' . $property->id . " saved, slug is " . $property->slug, Console::FG_GREEN, Console::BOLD) . PHP_EOL;
        }
    }
}