<?php

namespace backend\modules\management\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $key
 * @property string|null $value
 * @property string|null $field_type
 * @property string|null $tab
 */
class Setting extends \yii\db\ActiveRecord
{

    const TAB_CONTACT = 'contact';
    const TAB_SEO = 'seo';
    
    const FIELD_TYPE_STR = 'str';
    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_NUMBER = 'number';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    public static function getTabsArray(): array
    {
        return [
            self::TAB_CONTACT => Yii::t('app', 'SETTING_CONTACT_TAB'),
            self::TAB_SEO => Yii::t('app', 'SETTING_SEO_TAB'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'key', 'value', 'field_type', 'tab'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'field_type' => Yii::t('app', 'Field Type'),
            'tab' => Yii::t('app', 'Tab'),
        ];
    }
}
