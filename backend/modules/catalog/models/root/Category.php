<?php

namespace backend\modules\catalog\models\root;

use backend\interfaces\SingleTableInterface;
use backend\modules\catalog\models\DogCageCategory;
use backend\modules\catalog\models\DogCageGroup;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\items\CategoryItemTypeItems;
use backend\modules\catalog\models\items\GroupTypeItems;
use backend\modules\catalog\models\items\ProductItemType;
use backend\modules\catalog\models\query\CategoryQuery;
use backend\modules\catalog\models\RodentShowcaseCategory;
use backend\modules\catalog\models\RodentShowcaseGroup;
use backend\traits\fileTrait;
use backend\traits\InheritanceTrait;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $image
 * @property string|null $font_color
 * @property string|null $text_color
 * @property string|null $badge_color
 * @property string|null $comment
 * @property string|null $description
 * @property string $property_type
 * @property string $item_type
 * @property int|null $sort
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord implements SingleTableInterface
{
    use InheritanceTrait;
    use fileTrait;

    public $imageFile;

    public $files;

    const UPLOAD_PATH = 'uploads/category/';

    
    public static function tableName()
    {
        return '{{%category}}';
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => ['name'],
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    } 
    
   public static function instantiate($row)
   {
    // Категории
       if ($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT && $row['group_type'] == GroupTypeItems::GROUP_TYPE_CATEGORY) {
           return new RodentShowcaseCategory();
       } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT && $row['group_type'] == GroupTypeItems::GROUP_TYPE_CATEGORY) {
           return new DogCageCategory();
       }
    //    Группы
       elseif ($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT && $row['group_type'] == GroupTypeItems::GROUP_TYPE_GROUP) {
           return new RodentShowcaseGroup();
       } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT && $row['group_type'] == GroupTypeItems::GROUP_TYPE_GROUP) {
           return new DogCageGroup();
       } else {
           return new self;
       }
   }

   public static function find()
   {
       $cls = get_called_class();
       $clsItem = new $cls;
       return new CategoryQuery($cls, ['property_type' => $clsItem->property_type, 'item_type' => $clsItem->item_type, 'group_type' => $clsItem->group_type]);
   }
   
   public function init()
   {
       $this->property_type = $this->getType();
       $this->item_type = $this->getItemType();
       $this->group_type = $this->getGroupType();
       parent::init();
   }

    public function rules()
    {
        return [
            [['name', 'property_type', 'item_type'], 'required'],
            [['comment', 'description'], 'string'],
            [['sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'image', 'font_color', 'text_color', 'badge_color', 'property_type', 'item_type', 'status'], 'string', 'max' => 255],
           
            [['name'], 'unique', 'targetClass' => self::classname()],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            'imageFile' => [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, avif, svg'],
            [['imageFile', 'files'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'image' => Yii::t('app', 'Image'),
            'imageFile' => Yii::t('app', 'Image'),
            'font_color' => Yii::t('app', 'Font Color'),
            'text_color' => Yii::t('app', 'Text Color'),
            'badge_color' => Yii::t('app', 'Badge Color'),
            'comment' => Yii::t('app', 'Comment'),
            'description' => Yii::t('app', 'Description'),
            'property_type' => Yii::t('app', 'Property Type'),
            'item_type' => Yii::t('app', 'Item Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'files' => Yii::t('app', 'Gallery Files'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function getUploads()
    {
        return $this->hasMany(CategoryUpload::className(), ['category_id' => 'id']);
    }
    

    public function getType()
    {
        return $this->setType();
    }

    public function getItemTYpe()
    {
        return $this->setItemType();
    }

    public function getGroupType()
    {
        return $this->setGroupType();
    }

    /**
     * Устанавливает значение item_type в зависимости от имени дочернего класса
     *
     * @param string $cls
     * @return string|null
     */
    protected function setItemType(): ?string
    {
        $itemTypeChilds = CategoryItemTypeItems::getItemTypeChilds();
        foreach ($itemTypeChilds as $childCls => $itemType) {
            if (is_subclass_of($this, $childCls, true)) {
                return $itemType;
                break;
            }
        }
        return null;
    }

    /**
     * Возвращает значение типа продукта (product_type) в зависимости от дочернего класса
     *
     * @return string|null
     */
    protected function setType(): ?string
    {
        $cls = $this->getChildClassShortName();
        switch ($cls) {
            // Категории
            case 'RodentShowcaseCategory':
                return CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
            case 'DogCageCategory':
                return CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
            // Группы
            case 'RodentShowcaseGroup':
                return CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
            case 'DogCageGroup':
                return CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
            default:
                return null;
        }
    }

    protected function setGroupType()
    {
        $cls = $this->getChildClassShortName();
        switch ($cls) {
            // Категории
            case 'RodentShowcaseCategory':
                return GroupTypeItems::GROUP_TYPE_CATEGORY;
            case 'DogCageCategory':
                return GroupTypeItems::GROUP_TYPE_CATEGORY;
            // Группы
            case 'RodentShowcaseGroup':
                return GroupTypeItems::GROUP_TYPE_GROUP;
            case 'DogCageGroup':
                return GroupTypeItems::GROUP_TYPE_GROUP;
            default:
                return null;
        }
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (Yii::$app->request->isPost) {
                
                if ($this->validate()) {
                    
                    /**
                     * Загрузка файла изображения
                     */
                    $this->uploadFile('imageFile', 'image', self::UPLOAD_PATH); 
                } else {
                    foreach ($this->getErrors() as $key => $value) {
                        Yii::debug($key.': '.$value[0]);
                    }
                }
            }
            return true;
        }
        return false;
    }
    
    protected function setUploadAttribute()
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        if(isset($this->files) && !empty($this->files))
        {
            foreach ($this->files as $key=>$file) {
                $uploadModel = new CategoryUpload();
                $uploadModel->file = $file;
                $uploadModel->category_id = $this->id;
                $uploadModel->sort = $key;
                $uploadModel->save();
                foreach ($uploadModel->getErrors() as $error) {
                    Yii::error($file);
                    Yii::error($error);
                }
            }
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setUploadAttribute();
    
        parent::afterSave($insert, $changedAttributes);
    }
    
    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            /**
             * Удаление файла изображения
             */
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }
}
