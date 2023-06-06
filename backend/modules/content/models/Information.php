<?php

namespace backend\modules\content\models;

use backend\traits\fileTrait;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%information}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $video
 * @property int|null $sort
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Information extends \yii\db\ActiveRecord
{
    use fileTrait;
    
    public $imageFile;
    
    public $videoFile;

    const UPLOAD_PATH = 'uploads/information/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%information}}';
    }


    public function behaviors()
    {
        return[
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    } 
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'image', 'video', 'status'], 'string', 'max' => 255],

            [['name', 'description'], 'required'],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['videoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'avi, mpeg4, mp4, wmv'],
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
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'video' => Yii::t('app', 'Video'),
            'imageFile' => Yii::t('app', 'Image'),
            'videoFile' => Yii::t('app', 'Video'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\query\InformationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\content\models\query\InformationQuery(get_called_class());
    }

    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, false);
            $this->uploadFile("videoFile", "video", self::UPLOAD_PATH, false);
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            $this->deleteSingleFile('video', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
