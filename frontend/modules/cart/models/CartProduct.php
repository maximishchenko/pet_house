<?php

namespace frontend\modules\cart\models;

use backend\modules\catalog\models\root\Property;
use frontend\modules\cart\models\CartSession;
use frontend\modules\catalog\models\Product;

class CartProduct extends CartSession
{

    const PRODUCT_ID = 'product_id';
    const COLOR_ID = 'color_id';
    const WALL_ID = 'wall_id';
    const HEIGHT = 'height';
    const WIDTH = 'width';
    const DEPTH = 'depth';
    const COUNT = 'count';
    const NAME = 'name';
    const IMAGE = 'image';
    const PRICE = 'price';
    const OLD_PRICE = 'old_price';


    public $product_id;
    public $color_id;
    public $walls_id;
    public $height;
    public $width;
    public $depth;
    public $count;
    public $price;
    public $old_price;

    public function addToCart()
    {
        if ($this->isProductExists()) {
            $this->updateProductItemCount();
        } else {
            $this->createProductItemArray();
        }
        $this->session->set($this->cartSessionSection, $this->cartProducts);
    }

    public function getProductNameWithImage($product_id): array
    {
        $product = Product::find()->where(['id' => $product_id])->one();
        return ['name' => $product->name, 'image' => '/' . Product::UPLOAD_PATH . $product->image];
    }

    public function getProductPrice()
    {
        return ['price' => $this->price, 'old_price' => $this->old_price];
    }

    public function getColorName($color_id)
    {
        $color = Property::find()->where(['id' => $color_id])->one();
        return $color->name;
    }

    public function getWallName($wall_id)
    {
        $wall = Property::find()->where(['id' => $wall_id])->one();
        return $wall->name;
    }

    public function getCount($product_id)
    {
        return $this->cartProducts[$product_id][static::COUNT];
    }

    protected function isProductExists(): bool
    {
        if (isset($this->cartProducts[$this->product_id]) && !empty($this->cartProducts[$this->product_id])) {
            $existsProductInCart = $this->cartProducts[$this->product_id];
            // print_r($existsProductInCart);
            // die();
    // public $product_id;
    // public $color_id;
    // public $walls_id;
    // public $height;
    // public $width;
    // public $depth;
    // public $count;
    // public $price;
    // public $old_price;
            return 
                $this->color_id == $existsProductInCart['color_id'] && 
                $this->walls_id == $existsProductInCart['walls_id'] && 
                $this->height == $existsProductInCart['height'] && 
                $this->width == $existsProductInCart['width'] && 
                $this->depth == $existsProductInCart['price'] && 
                $this->price == $existsProductInCart['walls_id'] && 
                $this->old_price == $existsProductInCart['old_price'];
        }
        return false;
        return isset($this->cartProducts[$this->product_id]) && !empty($this->cartProducts[$this->product_id]);
    }

    protected function createProductItemArray()
    {
        $this->cartProducts[$this->product_id] = [
            static::PRODUCT_ID => $this->product_id,
            static::COLOR_ID => $this->color_id,
            static::WALL_ID => $this->walls_id,
            static::HEIGHT => $this->height,
            static::WIDTH => $this->width,
            static::DEPTH => $this->depth,
            static::COUNT => $this->count,
            static::PRICE => $this->price,
            static::OLD_PRICE => $this->old_price,
        ];
    }

    protected function updateProductItemCount($count = null)
    {
        if ($count == null) {
            $this->cartProducts[$this->product_id][static::COUNT] = $this->cartProducts[$this->product_id][static::COUNT] + 1 ;
        } else {
            $this->cartProducts[$this->product_id][static::COUNT] = $count;
        }
    }
}