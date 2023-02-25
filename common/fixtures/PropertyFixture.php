<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class PropertyFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\root\Property';
    public $dataFile = __DIR__ . '/data/property.php';
}