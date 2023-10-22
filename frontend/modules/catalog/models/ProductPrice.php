<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\abstracts\PropertyColor;
use backend\modules\catalog\models\abstracts\PropertyWall;
use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\root\Product;
use common\models\PriceValue;
use common\models\Status;
use Yii;

class ProductPrice 
{

    const PRICE_KEY = "price";

    const OLD_PRICE_KEY = "old_price";

    protected $product;

    protected $color;

    protected $wall;

    /**
     * Сумма стоимости размеров (высоты, ширины, глубины) заданные в конструкторе
     *
     * @var float
     */
    protected $newSizePrice;

    protected $startStepHeightValue;

    protected $currentStepHeightValue;

    protected $minStepHeightValue;

    protected $stepPriceHeightValue;

    protected $startStepWidthValue;

    protected $currentStepWidthValue;

    protected $minStepWidthValue;

    protected $stepPriceWidthValue;

    protected $startStepDepthValue;

    protected $currentStepDepthValue;

    protected $minStepDepthValue;

    protected $stepPriceDepthValue;

    protected $stepSizeValue;

    function __construct(
        $product_id, $color_id, $wall_id, $heightPrice, $widthPrice, $depthPrice,
        $startStepHeightValue, $currentStepHeightValue, $minStepHeightValue, $stepPriceHeightValue,
        $startStepWidthValue, $currentStepWidthValue, $minStepWidthValue, $stepPriceWidthValue,
        $startStepDepthValue, $currentStepDepthValue, $minStepDepthValue, $stepPriceDepthValue,
        $stepSizeValue
    )
    {
        $this->product = $this->getProduct($product_id);

        // 
        $this->startStepHeightValue = $startStepHeightValue;
        $this->currentStepHeightValue = $currentStepHeightValue;
        $this->minStepHeightValue = $minStepHeightValue;
        $this->stepPriceHeightValue = $stepPriceHeightValue;
        
        $this->startStepWidthValue = $startStepWidthValue;
        $this->currentStepWidthValue = $currentStepWidthValue;
        $this->minStepWidthValue = $minStepWidthValue;
        $this->stepPriceWidthValue = $stepPriceWidthValue;
        
        $this->startStepDepthValue = $startStepDepthValue;
        $this->currentStepDepthValue = $currentStepDepthValue;
        $this->minStepDepthValue = $minStepDepthValue;
        $this->stepPriceDepthValue = $stepPriceDepthValue;
        
        $this->stepSizeValue = $stepSizeValue;
        // 

        $this->newSizePrice = $this->getNewSizePriceByProductType($heightPrice, $widthPrice, $depthPrice);
        $this->color = $this->getColor($color_id);
        $this->wall = $this->getWall($wall_id);


    }

    public function getPriceValues(): array
    {
        $price = $this->getPrice();
        $oldPrice = $this->getOldPrice($price);
        
        return [
            static::PRICE_KEY => PriceValue::roundToHundreds($price), 
            static::OLD_PRICE_KEY => PriceValue::roundToHundreds($oldPrice),
        ];
    }
    
    /**
     * Вычисляет итоговую стоимость изделия с учетом наполнения из конструктора
     *
     * @return float
     */
    protected function getPrice(): float
    {
        return $this->product->price - $this->getCurrentItemsPrice() + $this->getNewItemsPrice();
    }

    /**
     * Стоимость изготовления размеров в первоначальной комплектации (указанной в панели управления)
     *
     * @param float $heightPrice
     * @param float $widthPrice
     * @param float $depthPrice
     * @return float
     */
    protected function getNewSizePriceByProductType($heightPrice, $widthPrice, $depthPrice): float
    {
        if ($this->product->product_type == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE) {
            $newHeightPrice = (($this->currentStepHeightValue - $this->minStepHeightValue) / $this->stepSizeValue) * $this->stepPriceHeightValue;
            $newWidthPrice = (($this->currentStepWidthValue - $this->minStepWidthValue) / $this->stepSizeValue) * $this->stepPriceWidthValue;
            $newDepthPrice = (($this->currentStepDepthValue - $this->minStepDepthValue) / $this->stepSizeValue) * $this->stepPriceDepthValue;
        } else {
            $newHeightPrice = $heightPrice;
            $newWidthPrice = $widthPrice;
            $newDepthPrice = $depthPrice;
        }
        return $newHeightPrice + $newWidthPrice + $newDepthPrice;
    }

    protected function getCurrentSizePriceByProductType()
    {
        if ($this->product->product_type == CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE) {
            $currentHeightPrice = (($this->startStepHeightValue - $this->minStepHeightValue) / $this->stepSizeValue) * $this->stepPriceHeightValue;
            $currentWidthPrice = (($this->startStepWidthValue - $this->minStepWidthValue) / $this->stepSizeValue) * $this->stepPriceWidthValue;
            $currentDepthPrice = (($this->startStepDepthValue - $this->minStepDepthValue) / $this->stepSizeValue) * $this->stepPriceDepthValue;
        } else {
            $currentHeightPrice = $this->product->size->height_price;
            $currentWidthPrice = $this->product->size->width_price;
            $currentDepthPrice = $this->product->size->depth_price;
        }
        return $currentHeightPrice + $currentWidthPrice + $currentDepthPrice;
    }

    /**
     * Исходные данные изделия для которого вычисляется стоимость (указанные в панели управления)
     *
     * @param integer $productId
     * @return Product
     */
    protected function getProduct(int $productId): Product
    {
        $product = Product::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $productId])->one();
        return $product;
    }

    /**
     * Стоимость комплектующих изделия (витрины, клетки и т.д.) в первоначальной комплектации (указанной в панели управления)
     *
     * @return float
     */
    protected function getCurrentItemsPrice(): float
    {
        // $currentSizePrice = $this->product->size->height_price + $this->product->size->width_price + $this->product->size->depth_price;
        $currentSizePrice = $this->getCurrentSizePriceByProductType();
        $currentColorPrice = $this->product->color->price;
        $currentWallPrice = $this->product->wall->price;
        return $currentSizePrice + $currentColorPrice + $currentWallPrice;
    }

    /**
     * Стоимость комплектующих издения (витраны, клетки и т.п.) выбранные в конструкторе
     *
     * @return float
     */
    protected function getNewItemsPrice(): float
    {
        $newSizePrice = $this->newSizePrice;
        $newColorPrice = $this->color->price;
        $newWallPrice = $this->wall->price;
        return $newSizePrice + $newColorPrice + $newWallPrice;
    }

    /**
     * Возвращает данные цвета, заданного в конструкторе
     */
    protected function getColor(int $color_id)
    {
        return PropertyColor::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $color_id])->one();
    }

    /**
     * Возвращает данные материала стен, заданного в конструкторе
     */
    protected function getWall(int $wall_id)
    {
        return PropertyWall::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $wall_id])->one();
    }  

    /**
     * Вычисляет цену без учета скидок
     *
     * @param int $price
     * @return integer
     */
    protected function getOldPrice(int $price): int
    {
        if (isset($this->product->discount) && !empty($this->product->discount)) {
            $discount = $this->product->discount;
            $oldPrice = $price + (($price * $discount) / 100);
            return $oldPrice;
        }
        return $price;
    }
}