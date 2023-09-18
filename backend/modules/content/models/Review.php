<?php

namespace backend\modules\content\models;

use backend\traits\fileTrait;
use common\models\Sort;
use Yii;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $image
 * @property string|null $avatar
 * @property string|null $status
 * @property int|null $is_favorite
 * @property string|null $text
 * @property int|null $sort
 * @property int|null $created_at
 */
class Review extends \yii\db\ActiveRecord
{
    use fileTrait;

    public $imageFile;

    public $avatarFile;

    const UPLOAD_PATH = 'uploads/reviews/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%review}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_favorite', 'sort'], 'integer'],
            [['text'], 'string'],
            [['name', 'image', 'avatar', 'status'], 'string', 'max' => 255],
            
            [['name'], 'required'],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp'],
            [['created_at'], 'datetime', 'format' => 'dd.MM.yyyy'],
            [['avatarFile', 'imageFile'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Client Review Name'),
            'image' => Yii::t('app', 'Image'),
            'imageFile' => Yii::t('app', 'Image'),
            'avatar' => Yii::t('app', 'Avatar'),
            'avatarFile' => Yii::t('app', 'Avatar'),
            'status' => Yii::t('app', 'Status'),
            'is_favorite' => Yii::t('app', 'Is Favorite'),
            'text' => Yii::t('app', 'Review Text'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\content\models\query\ReviewQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\content\models\query\ReviewQuery(get_called_class());
    }


    public function afterFind()
    {
        if ($this->created_at != null) {
            $this->created_at = Yii::$app->formatter->asDate($this->created_at);
        } else {
            $this->created_at = null;
        }
        parent::afterFind();
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if ($this->created_at != null) {
                $this->created_at = strtotime($this->created_at);
            }

            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, false);
            $this->uploadFile("avatarFile", "avatar", self::UPLOAD_PATH, false);
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            $this->deleteSingleFile('avatar', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
