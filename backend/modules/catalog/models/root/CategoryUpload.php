<?php

namespace backend\modules\catalog\models\root;

use backend\traits\fileTrait;
use common\components\FileType;
use common\models\Sort;
use yii\imagine\Image;
use Imagine\Image\Box;
use Yii;

/**
 * This is the model class for table "{{%category_upload}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $sort
 * @property string $file_path
 * @property string $file_type
 */
class CategoryUpload extends \yii\db\ActiveRecord
{
    use fileTrait;

    public $file;

    const UPLOAD_PATH = 'uploads/gallery/';

    const PREVIEW_UPLOAD_PATH = 'uploads/gallery/preview/';
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category_upload}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['category_id', 'file_path', 'file_type'], 'required'],
            [['category_id', 'sort'], 'integer'],
            [['file_path', 'file_type'], 'string', 'max' => 255],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, avif, svg, avi, mp4, mov'],
            [['file'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'file_path' => Yii::t('app', 'File Path'),
            'file_type' => Yii::t('app', 'File Type'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\CategoryUploadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\catalog\models\query\CategoryUploadQuery(get_called_class());
    }

    public function getUpload()
    {
        return Yii::getAlias('@frontend/web/' . self::UPLOAD_PATH . $this->file_path);
        // return "/" . self::UPLOAD_PATH . $this->file_path;
    }

    public function getUploadPreview()
    {
        return Yii::getAlias('@frontend/web/' . self::UPLOAD_PATH . self::PREVIEW_UPLOAD_PATH . $this->file_path);
        // return self::UPLOAD_PATH . self::PREVIEW_UPLOAD_PATH . $this->file_path;
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!isset($this->file_type) || empty($this->file_type)) {
                $this->file_type = $this->setFileType();
            }
            $this->uploadFile("file", "file_path", self::UPLOAD_PATH, true);
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->getPreview();
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            /**
             * Удаление файла изображения
             */
            $this->deleteSingleFile('file_path', self::PREVIEW_UPLOAD_PATH);
            $this->deleteSingleFile('file_path', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }

    protected function getPreview()
    {
        $file = $this->getUpload();
        $mime = mime_content_type($file);
        if (strstr($mime, "video/")) {
            $this->file_type = FileType::TYPE_VIDEO;
            $this->getVideoPreview($file);
        } elseif (strstr($mime, "image/")) {
            $this->file_type = FileType::TYPE_IMAGE;
            $this->getImagePreview($file);
        }
    }

    protected function setFileType()
    {
        if (strstr($this->file->type, "image/")) {
            return FileType::TYPE_IMAGE;
        } elseif (strstr($this->file->type, "video/")) {
            return FileType::TYPE_VIDEO;
        }
    }

    protected function getImagePreview($file)
    {
        // Yii::getAlias('@frontend/web/' . self::UPLOAD_PATH . self::PREVIEW_UPLOAD_PATH . $this->file_path);
        Image::getImagine()->open($file)
            ->thumbnail(new Box(600, 400))
            ->save(Yii::getAlias('@frontend/web/' . self::PREVIEW_UPLOAD_PATH . $this->file_path) , ['quality' => 90]);
    }

    protected function getVideoPreview($file)
    {

    }
}
