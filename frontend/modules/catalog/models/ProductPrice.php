<?php

namespace frontend\modules\catalog\models;

use backend\modules\catalog\models\abstracts\PropertyColor;
use backend\modules\catalog\models\abstracts\PropertySize;
use backend\modules\catalog\models\abstracts\PropertyWall;
use backend\modules\catalog\models\root\Product;
use common\models\PriceValue;
use common\models\Size;
use common\models\Status;
use Yii;

class ProductPrice 
{

    const PRICE_KEY = "price";

    const OLD_PRICE_KEY = "old_price";
    
    protected $product_id;

    protected $color_id;

    protected $size_id;

    protected $walls_id;

    protected $product;

    protected $size;

    protected $color;

    protected $wall;


    function __construct($product_id, $color_id, $size_id, $walls_id)
    {
        $this->product_id = $product_id;
        $this->color_id = $color_id;
        $this->size_id = $size_id;
        $this->walls_id = $walls_id;

        $this->product = $this->getCurrentProduct();
        $this->size = $this->getItemSize();
        $this->color = $this->getItemColor();
        $this->wall = $this->getItemWall();
    }

    public function getPriceValues(): array
    {
        // Базовая стоимость каркаса в размерах, указанных в конструкторе
        $basePrice = $this->getBasePrice();
        // Стоимость аксессуаров, включенных в стоимость витрины
        $accessoriesPrice = $this->getAccessoriesPrice();
        // Стоимость комплектующих, указанных в конструкторе (краска, стены и т.п.)
        $itemsPrice = $this->getItemsPrice();
        $price = $basePrice + $accessoriesPrice + $itemsPrice;
        $price = PriceValue::roundToHundreds($price);
        return [
            static::PRICE_KEY => Yii::$app->formatter->asCurrency($price, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100]), 
            static::OLD_PRICE_KEY => Yii::$app->formatter->asCurrency(40000, null, [\NumberFormatter::MAX_SIGNIFICANT_DIGITS => 100])
        ];
    }

    protected function getCurrentProduct(): Product
    {
        $product = Product::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $this->product_id])->one();
        return $product;
    }

    /**
     * Возвращает данные размеров, заданных в конструкторе
     */
    protected function getItemSize()
    {
        return PropertySize::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $this->size_id])->one();
    }

    /**
     * Возвращает данные цвета, заданного в конструкторе
     */
    protected function getItemColor()
    {
        return PropertyColor::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $this->color_id])->one();
    }

    /**
     * Возвращает данные материала стен, заданного в конструкторе
     */
    protected function getItemWall()
    {
        return PropertyWall::find()->where(['status' => Status::STATUS_ACTIVE, 'id' => $this->walls_id])->one();
    }

    /**
     * Возвращает базовую стоимость каркаса с учетом исходной стоимости и размеров, заданных в конструкторе
     */
    protected function getBasePrice()
    {
        // Приведение форматов исходных размеров из мм в м
        $baseHeight = Size::convertMilimeterToMeter($this->product->size->height);
        $baseWidth = Size::convertMilimeterToMeter($this->product->size->width);
        $baseDepth = Size::convertMilimeterToMeter($this->product->size->depth);
        // Приведение форматов указанных размеров из мм в м
        $sizeHeight = Size::convertMilimeterToMeter($this->size->height);
        $sizeWidth = Size::convertMilimeterToMeter($this->size->width);
        $sizeDepth = Size::convertMilimeterToMeter($this->size->depth);
        // Чистая стоимость каркаса в исходных размерах
        $base = $this->product->price - $this->product->wall->price - $this->product->color->price;
        // Базовая стоимость каркаса в исходных размерах
        $basePriceSource = $base / ($baseHeight * $baseWidth * $baseDepth);
        // Базовая стоимость каркаса в размерах, указанных в конструкторе
        $basePrice = $basePriceSource * ($sizeHeight * $sizeWidth * $sizeDepth);
        return $basePrice;
    }

    /**
     * Стоимость текущих аксессуаров витрины
     *
     * @return integer
     */
    protected function getAccessoriesPrice(): int
    {
        // $accessoriesPrice = 0;
        // foreach ($this->product->activeAccessories as $accessory) {
        //     $accessoriesPrice += $accessory->price;
        // }
        // return $accessoriesPrice;
        return 0;
    }

    /**
     * Стоимость выбранных комплектующих (покраска, стенки)
     *
     * @return integer
     */
    protected function getItemsPrice(): int
    {
        return $this->color->price + $this->wall->price;
    }    
}