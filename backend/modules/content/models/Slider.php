<?php

namespace backend\modules\content\models;

use backend\traits\fileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $url
 * @property string|null $video
 * @property string|null $image
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Slider extends \yii\db\ActiveRecord
{
    use fileTrait;

    public $imageFile;

    public $videoFile;

    public $imageFileMobile;

    public $videoFileMobile;

    const UPLOAD_PATH = 'uploads/slider/';

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
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'comment'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'url', 'video', 'image', 'text_color', 'button_text_color', 'button_bg_color', 'video_mobile', 'image_mobile'], 'string', 'max' => 255],
            [['url'], 'url'],

            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            [['text_color'], 'default', 'value'=> "#000000"],
            [['button_text_color'], 'default', 'value'=> "#FFFFFF"],
            [['button_bg_color'], 'default', 'value'=> "#373737"],
            [['imageFile', 'imageFileMobile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['videoFile', 'videoFileMobile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4, avi'],
         
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
            'url' => Yii::t('app', 'Slider Url'),
            'video' => Yii::t('app', 'Video'),
            'image' => Yii::t('app', 'Image'),
            'videoFile' => Yii::t('app', 'Video'),
            'imageFile' => Yii::t('app', 'Image'),
            'videoFileMobile' => Yii::t('app', 'Video Mobile'),
            'imageFileMobile' => Yii::t('app', 'Image Mobile'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'text_color' => Yii::t('app', 'Text Color'),
            'button_text_color' => Yii::t('app', 'Button Text Color'),
            'button_bg_color' => Yii::t('app', 'Button Background Color'),
            'video_mobile' => Yii::t('app', 'Video Mobile'),
            'image_mobile' => Yii::t('app', 'Image Mobile'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\query\SliderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\content\models\query\SliderQuery(get_called_class());
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, false);
            $this->uploadFile("videoFile", "video", self::UPLOAD_PATH, false);
            $this->uploadFile("imageFileMobile", "image_mobile", self::UPLOAD_PATH, false);
            $this->uploadFile("videoFileMobile", "video_mobile", self::UPLOAD_PATH, false);
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            $this->deleteSingleFile('video', self::UPLOAD_PATH);
            $this->deleteSingleFile('image_mobile', self::UPLOAD_PATH);
            $this->deleteSingleFile('video_mobile', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
