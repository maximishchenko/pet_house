<?php

namespace backend\modules\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%property_link}}".
 *
 * @property int $source_id
 * @property int $target_id
 * @property string $item_type
 * @property string $property_type
 */
class PropertyLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%property_link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_id', 'target_id', 'item_type', 'property_type'], 'required'],
            [['source_id', 'target_id'], 'integer'],
            [['item_type', 'property_type'], 'string', 'max' => 255],
            [['source_id', 'target_id'], 'unique', 'targetAttribute' => ['source_id', 'target_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'source_id' => Yii::t('app', 'Source ID'),
            'target_id' => Yii::t('app', 'Target ID'),
            'item_type' => Yii::t('app', 'Item Type'),
            'property_type' => Yii::t('app', 'Property Type'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\PropertyLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\PropertyLinkQuery(get_called_class());
    }
}
