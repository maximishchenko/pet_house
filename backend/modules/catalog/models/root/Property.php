<?php

namespace backend\modules\catalog\models\root;

use backend\interfaces\SingleTableInterface;
use backend\modules\catalog\models\DogCageColor;
use backend\modules\catalog\models\DogCageEngraving;
use backend\modules\catalog\models\DogCageMaterial;
use backend\modules\catalog\models\DogCageSize;
use backend\modules\catalog\models\DogCageType;
use backend\modules\catalog\models\DogCageWall;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\PropertyImage;
use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\query\PropertyQuery;
use backend\modules\catalog\models\RodentShowcaseColor;
use backend\modules\catalog\models\RodentShowcaseEngraving;
use backend\modules\catalog\models\RodentShowcaseMaterial;
use backend\modules\catalog\models\RodentShowcaseSize;
use backend\modules\catalog\models\RodentShowcaseType;
use backend\modules\catalog\models\RodentShowcaseWall;
use backend\traits\fileTrait;
use backend\traits\InheritanceTrait;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%property}}".
 *
 * @property int $id
 * @property string $name
 * @property float|null $price
 * @property string|null $image
 * @property string|null $comment
 * @property int|null $sort
 * @property string|null $status
 * @property string $property_type
 * @property string $item_type
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Product[] $products
 * @property PropertyImage[] $propertyImages
 */
class Property extends \yii\db\ActiveRecord implements SingleTableInterface
{

    use InheritanceTrait;
    use fileTrait;

    public $imageFile;

    const UPLOAD_PATH = 'uploads/property/';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%property}}';
    }
    
    /**
     * Возвращает 
     *
     * @param [type] $row
     * @return void
     */
    public static function instantiate($row)
    {
        if ($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE) {
            return new RodentShowcaseSize();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE) {
            return new DogCageSize();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE) {
            return new RodentShowcaseType();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE) {
            return new DogCageType();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL) {
            return new RodentShowcaseMaterial();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL) {
            return new DogCageMaterial();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_ENGRAVING) {
            return new RodentShowcaseEngraving();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_ENGRAVING) {
            return new DogCageEngraving();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL) {
            return new RodentShowcaseWall();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL) {
            return new DogCageWall();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR) {
            return new RodentShowcaseColor();
        } elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR) {
            return new DogCageColor();
        } else {
            return new self;
        }
    }

    /**
     * {@inheritdoc}
     * @return PropertyQuery the active query used by this AR class.
     */
    public static function find()
    {
        $cls = get_called_class();
        $clsItem = new $cls;
        return new PropertyQuery($cls, ['property_type' => $clsItem->property_type, 'item_type' => $clsItem->item_type]);
    }
    
    public function init()
    {
        $this->property_type = $this->getType();
        $this->item_type = $this->getItemType();
        parent::init();
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
            [['property_type', 'item_type'], 'required'],
            'name' => ['name', 'required'],
            // [['name'], 'unique', 'targetClass' => self::classname()],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            [['text_color'], 'default', 'value'=> '#000000'],
            ['property_type', 'in', 'range' => array_keys(CatalogTypeItems::getCatalogTypesArray())],
            ['item_type', 'in', 'range' => array_keys(PropertyItemTypeItems::getItemTypesArray())],
            [['price'], 'number'],
            [['comment'], 'string'],
            [['sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'image', 'status', 'property_type', 'item_type'], 'string', 'max' => 255],

            'imageFile' => [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, webp, avif, svg'],
            [['imageFile', 'width_price', 'height_price', 'depth_price', 'text_color'], 'safe'],
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
            'price' => Yii::t('app', 'Price'),
            'image' => Yii::t('app', 'Image'),
            'imageFile' => Yii::t('app', 'Image'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'property_type' => Yii::t('app', 'Property Type'),
            'item_type' => Yii::t('app', 'Item Type'),
            'text_color' => Yii::t('app', 'Property Text Color'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['color_id' => 'id']);
    }

    /**
     * Gets query for [[PropertyImages]].
     *
     * @return \yii\db\ActiveQuery|PropertyImageQuery
     */
    public function getPropertyImages()
    {
        return $this->hasMany(PropertyImage::className(), ['property_id' => 'id']);
    }
    
    /**
     * Возвращает значение типа раздела (item_type) в зависимости от имени дочернего класса
     *
     * @return string|null
     */
    public function getItemType(): ?string
    {
        return $this->setItemType();
    }

    /**
     * Возвращает значение типа продукта в зависимости от дочернего класса
     *
     * @return void
     */
    public function getType()
    {
        return $this->setType();
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // if (Yii::$app->request->isPost) {
                
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
            // }
            return true;
        }
        return false;
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

    /**
     * Устанавливает значение item_type в зависимости от имени дочернего класса
     *
     * @param string $cls
     * @return string|null
     */
    protected function setItemType(): ?string
    {
        $itemTypeChilds = PropertyItemTypeItems::getItemTypeChilds();
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
            case 'RodentShowcaseSize':
            case 'RodentShowcaseType':
            case 'RodentShowcaseMaterial':
            case 'RodentShowcaseEngraving':
            case 'RodentShowcaseWall':
            case 'RodentShowcaseColor':
                return CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
            case 'DogCageSize':
            case 'DogCageType':
            case 'DogCageMaterial':
            case 'DogCageEngraving':
            case 'DogCageWall':
            case 'DogCageColor':
                return CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
            default:
                return null;
        }
    }
}
