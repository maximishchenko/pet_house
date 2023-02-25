<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class AttributeFixture extends ActiveFixture
{
    public $modelClass = 'backend\modules\catalog\models\root\Attribute';
    public $dataFile = __DIR__ . '/data/attribute.php';
}