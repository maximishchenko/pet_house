<?php

namespace backend\modules\seo\models;

use common\models\Core;
use Yii;

/**
 * This is the model class for table "{{%script}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $position
 * @property string|null $code
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Script extends \yii\db\ActiveRecord
{

    const BEFORE_END_HEAD = 'beforeEndHead';
    const AFTER_BEGIN_BODY = 'afterBeginBody';
    const BEFORE_END_BODY = 'beforeEndBody';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%script}}';
    }

    public static function getScriptPositionsArray(): array
    {
        return [
            static::BEFORE_END_HEAD => Yii::t('app', 'Script Before End Head'),
            static::AFTER_BEGIN_BODY => Yii::t('app', 'Script After Begin Body'),
            static::BEFORE_END_BODY => Yii::t('app', 'Script Before End Body'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 50],
            [['name'], 'unique'],

            [['name', 'position', 'code'], 'required'],
            
            ['sort', 'default', 'value' => Core::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Core::getStatusesArray())],
            ['position', 'in', 'range' => array_keys(self::getScriptPositionsArray())],
            ['position', 'default', 'value' => self::BEFORE_END_HEAD],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Script Name'),
            'position' => Yii::t('app', 'Script Position'),
            'code' => Yii::t('app', 'Script Code'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
