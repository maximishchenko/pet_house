<?php

namespace backend\modules\catalog\models\root;

use backend\interfaces\SingleTableInterface;
use backend\modules\catalog\models\DogCageAttribute;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\items\ProductItemType;
use backend\modules\catalog\models\query\AttributeQuery;
use backend\modules\catalog\models\RodentShowcaseAttribute;
use backend\traits\InheritanceTrait;
use common\models\Sort;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property int|null $sort
 * @property string|null $status
 * @property string|null $product_type
 * @property string|null $item_type
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ProductAttribute[] $productAttributes
 * @property Product[] $products
 * @property ProductMaterial[] $productMaterials
 * @property Product[] $products0
 */
class Attribute extends \yii\db\ActiveRecord implements SingleTableInterface
{
    use InheritanceTrait;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute}}';
    }
    
    /**
     * Возвращает 
     *
     * @param [type] $row
     * @return void
     */
    public static function instantiate($row)
    {
        if ($row['product_type'] == CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT) {
            return new RodentShowcaseAttribute();
        } elseif($row['product_type'] == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE && $row['item_type'] == ProductItemType::PRODUCT_TYPE_PRODUCT) {
            return new DogCageAttribute();
        } else {
            return new self;
        }
    }

    /**
     * {@inheritdoc}
     * @return \backend\modules\catalog\models\query\AttributeQuery the active query used by this AR class.
     */
    public static function find()
    {
        $cls = get_called_class();
        $clsItem = new $cls;
        return new AttributeQuery($cls, ['product_type' => $clsItem->product_type, 'item_type' => $clsItem->item_type]);
    }
    
    public function init()
    {
        $this->product_type = $this->getType();
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
            [['name', 'value'], 'required'],
            [['sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'value', 'status', 'product_type', 'item_type'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetClass' => self::classname()],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE],
            ['product_type', 'in', 'range' => array_keys(CatalogTypeItems::getCatalogTypesArray())],
            ['item_type', 'in', 'range' => array_keys(ProductItemType::getItemTypesArray())],
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
            'value' => Yii::t('app', 'Value'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'product_type' => Yii::t('app', 'Product Type'),
            'item_type' => Yii::t('app', 'Item Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function getType()
    {
        return $this->setType();
    }

    public function getItemTYpe()
    {
        return $this->setItemType();
    }

    /**
     * Gets query for [[ProductAttributes]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\catalog\models\query\ProductAttributeQuery
     */
    // public function getProductAttributes()
    // {
    //     return $this->hasMany(ProductAttribute::className(), ['attribute_id' => 'id']);
    // }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\catalog\models\query\ProductQuery
     */
    // public function getProducts()
    // {
    //     return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_attribute}}', ['attribute_id' => 'id']);
    // }

    /**
     * Gets query for [[ProductMaterials]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\catalog\models\query\ProductMaterialQuery
     */
    // public function getProductMaterials()
    // {
    //     return $this->hasMany(ProductMaterial::className(), ['material_id' => 'id']);
    // }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\catalog\models\query\ProductQuery
     */
    // public function getProducts0()
    // {
    //     return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_material}}', ['material_id' => 'id']);
    // }

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
            case 'RodentShowcaseAttribute':
                return CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
            case 'DogCageAttribute':
                return CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
            default:
                return null;
        }
    }
}
