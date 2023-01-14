<?php

namespace backend\modules\seo\models;

use common\models\Core;
use Yii;

/**
 * This is the model class for table "{{%meta_tag}}".
 *
 * @property int $id
 * @property string|null $url
 * @property string|null $meta_title
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $og_title
 * @property string|null $og_description
 * @property string|null $og_image
 * @property string|null $og_url
 * @property string|null $og_sitename
 * @property string|null $og_type
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class MetaTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%meta_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meta_description', 'og_description', 'og_image'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['url', 'meta_title', 'meta_keywords', 'og_title', 'og_url', 'og_sitename', 'og_type'], 'string', 'max' => 255],
            [['url'], 'unique'],

            [['url', 'meta_title'], 'required'],
            ['sort', 'default', 'value' => Core::DEFAULT_SORT_VALUE],
            ['status', 'in', 'range' => array_keys(Core::getStatusesArray())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'og_title' => Yii::t('app', 'Og Title'),
            'og_description' => Yii::t('app', 'Og Description'),
            'og_image' => Yii::t('app', 'Og Image'),
            'og_url' => Yii::t('app', 'Og Url'),
            'og_sitename' => Yii::t('app', 'Og Sitename'),
            'og_type' => Yii::t('app', 'Og Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
