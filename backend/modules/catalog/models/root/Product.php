<?php

namespace backend\modules\catalog\models\root;

use backend\interfaces\SingleTableInterface;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\items\ProductItemType;
use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\ProductImage;
use backend\modules\catalog\models\query\ProductQuery;
use backend\modules\catalog\models\query\PropertyQuery;
use backend\modules\catalog\models\RodentShowcaseProduct;
use backend\traits\fileTrait;
use backend\traits\InheritanceTrait;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $slug
 * @property int|null $category_id
 * @property int|null $type_id
 * @property int|null $material_id
 * @property int|null $color_id
 * @property int|null $wall_id
 * @property int|null $engraving_id
 * @property int|null $size_id
 * @property int|null $is_available
 * @property float|null $price
 * @property int|null $discount
 * @property int|null $is_fix_price
 * @property int|null $is_constructor_blocked
 * @property string|null $comment
 * @property string|null $description
 * @property int|null $view_count
 * @property string|null $product_type
 * @property string|null $item_type
 * @property int|null $sort
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Category $category
 * @property Property $color
 * @property Property $engraving
 * @property Property $material
 * @property Property $type
 * @property Property $type0
 * @property Property $wall
 * @property ProductAttribute[] $productAttributes
 * @property Attribute[] $attributes0
 * @property ProductImage[] $productImages
 * @property ProductMaterial[] $productMaterials
 * @property Attribute[] $materials
 */
class Product extends \yii\db\ActiveRecord implements SingleTableInterface
{
    use InheritanceTrait;
    use fileTrait;

    /**
     * Возвращает 
     *
     * @param [type] $row
     * @return void
     */
    public static function instantiate($row)
    {
        if (
            $row['product_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && 
            $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT) {
            return new RodentShowcaseProduct();
        } 
        // elseif($row['property_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE) {
            // return new DogCageSize();
        // } 
        else {
            return new self;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
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
    

    /**
     * {@inheritdoc}
     * @return PropertyQuery the active query used by this AR class.
     */
    public static function find()
    {
        $cls = get_called_class();
        $clsItem = new $cls;
        return new ProductQuery($cls, ['product_type' => $clsItem->product_type, 'item_type' => $clsItem->item_type]);
    }
    
    public function init()
    {
        $this->product_type = $this->getType();
        $this->item_type = $this->getItemType();
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'type_id', 'material_id', 'color_id', 'wall_id', 'engraving_id', 'size_id', 'is_available', 'discount', 'is_fix_price', 'is_constructor_blocked', 'view_count', 'sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
            [['comment', 'description'], 'string'],
            [['name', 'slug', 'product_type', 'item_type', 'status'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['engraving_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['engraving_id' => 'id']],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['material_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['wall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['wall_id' => 'id']],

            [['name', 'category_id'], 'required'],
            [['name'], 'unique'],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
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
            'slug' => Yii::t('app', 'Slug'),
            'category_id' => Yii::t('app', 'Category ID'),
            'type_id' => Yii::t('app', 'Type ID'),
            'material_id' => Yii::t('app', 'Material ID'),
            'color_id' => Yii::t('app', 'Color ID'),
            'wall_id' => Yii::t('app', 'Wall ID'),
            'engraving_id' => Yii::t('app', 'Engraving ID'),
            'size_id' => Yii::t('app', 'Size ID'),
            'is_available' => Yii::t('app', 'Is Available'),
            'price' => Yii::t('app', 'Price'),
            'discount' => Yii::t('app', 'Discount'),
            'is_fix_price' => Yii::t('app', 'Is Fix Price'),
            'is_constructor_blocked' => Yii::t('app', 'Is Constructor Blocked'),
            'comment' => Yii::t('app', 'Comment'),
            'description' => Yii::t('app', 'Description'),
            'view_count' => Yii::t('app', 'View Count'),
            'product_type' => Yii::t('app', 'Product Type'),
            'item_type' => Yii::t('app', 'Item Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    // public function getCategory()
    // {
    //     return $this->hasOne(Category::className(), ['id' => 'category_id']);
    // }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery|PropertyQuery
     */
    // public function getColor()
    // {
    //     return $this->hasOne(Property::className(), ['id' => 'color_id']);
    // }

    /**
     * Gets query for [[Engraving]].
     *
     * @return \yii\db\ActiveQuery|PropertyQuery
     */
    // public function getEngraving()
    // {
    //     return $this->hasOne(Property::className(), ['id' => 'engraving_id']);
    // }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery|PropertyQuery
     */
    // public function getMaterial()
    // {
    //     return $this->hasOne(Property::className(), ['id' => 'material_id']);
    // }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|PropertyQuery
     */
    // public function getType()
    // {
    //     return $this->hasOne(Property::className(), ['id' => 'type_id']);
    // }

    /**
     * Gets query for [[Wall]].
     *
     * @return \yii\db\ActiveQuery|PropertyQuery
     */
    // public function getWall()
    // {
    //     return $this->hasOne(Property::className(), ['id' => 'wall_id']);
    // }

    /**
     * Gets query for [[ProductAttributes]].
     *
     * @return \yii\db\ActiveQuery|ProductAttributeQuery
     */
    // public function getProductAttributes()
    // {
    //     return $this->hasMany(ProductAttribute::className(), ['product_id' => 'id']);
    // }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery|AttributeQuery
     */
    // public function getAttributes0()
    // {
    //     return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%product_attribute}}', ['product_id' => 'id']);
    // }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery|ProductImageQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductMaterials]].
     *
     * @return \yii\db\ActiveQuery|ProductMaterialQuery
     */
    // public function getProductMaterials()
    // {
    //     return $this->hasMany(ProductMaterial::className(), ['product_id' => 'id']);
    // }

    /**
     * Gets query for [[Materials]].
     *
     * @return \yii\db\ActiveQuery|AttributeQuery
     */
    // public function getMaterials()
    // {
    //     return $this->hasMany(Attribute::className(), ['id' => 'material_id'])->viaTable('{{%product_material}}', ['product_id' => 'id']);
    // }

    /**
     * {@inheritdoc}
     * @return PropertyQuery the active query used by this AR class.
     */
    // public static function find()
    // {
    //     return new PropertyQuery(get_called_class());
    // }
    
    
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
    

    /**
     * Устанавливает значение item_type в зависимости от имени дочернего класса
     *
     * @param string $cls
     * @return string|null
     */
    protected function setItemType(): ?string
    {
        $itemTypeChilds = ProductItemType::getItemTypeChilds();
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
            case 'RodentShowcaseProduct':
                return CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
            case 'DogCageProduct':
                return CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
            default:
                return null;
        }
    }

    // 

    /**
     * Выпадающий список категорий
     *
     * @return void
     */
    public function getCategoriesItems()
    {
        $categories = Category::find()
                        ->where([
                            'item_type' => $this->item_type,
                            'property_type' => $this->product_type
                        ])->all(); 
        $items = ArrayHelper::map($categories,'id', 'name');
        return $items;
    }

    /**
     * Параметры выпадающего списка категорий
     *
     * @return void
     */
    public function getCategoriesParams()
    {
        return ['prompt' => Yii::t('app', 'Choose product category')];
    }
    
    /**
     * Генерация данных выпадающего списка свойств в зависимости от типа параметра и вида продукта
     *
     * @param [type] $item_type
     * @return void
     */
    public function getPropertiesItems($item_type)
    {
        $properties = Property::find()
                        ->where([
                            'item_type' => $item_type,
                            'property_type' => $this->product_type
                        ])->all(); 
        $items = ArrayHelper::map($properties,'id', 'name');
        return $items;
    }

    /**
     * Генерация параметров выпадающего списка свойств в зависимости от типа свойства
     *
     * @param [type] $param_type
     * @return void
     */
    public function getPropertiesParams($param_type)
    {
        $params = [
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE => Yii::t('app', 'Choose product type'),
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE => Yii::t('app', 'Choose product size'),
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_MATERIAL => Yii::t('app', 'Choose product material'),
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_COLOR => Yii::t('app', 'Choose product color'),
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_ENGRAVING => Yii::t('app', 'Choose product engraving'),
            PropertyItemTypeItems::PROPERTY_ITEM_TYPE_WALL => Yii::t('app', 'Choose product wall'),
        ];
        return ['prompt' => $params[$param_type]];
    }

}
