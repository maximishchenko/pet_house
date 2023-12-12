<?php

namespace frontend\modules\cart\models;

use frontend\modules\cart\models\CartSession;
class Cart extends CartSession
{
    public static function getTotalCount(): int
    {
        $cart = new self();
        $count = 0;
        if ($cart->cartProducts) {
            foreach ($cart->cartProducts as $k => $product) {
                $count = $count + $product['count'];
            }
        }
        return $count;
        return count($cart->cartProducts);
    }

    public static function getTotalPrice(): int
    {
        $cart = new self();
        $totalPrice = 0;
        foreach ($cart->cartProducts as $product) {
            $cartItem = new CartProduct();
            // $price = $product['price'];
            // $count = $cartItem->getCount($product[CartProduct::PRODUCT_ID]);
            $price = $product[CartProduct::PRICE];
            $count = $product[CartProduct::COUNT];
            $itemPrice = $price * $count;
            $totalPrice = $totalPrice + $itemPrice;
        }
        return $totalPrice;
    }

    public static function getItemCount($product_id): int
    {
        $cart = new CartProduct();
        return $cart->getCount($product_id);
    }

    public function clearCart()
    {
        $this->session->set($this::$cartSessionSection, []);
    }

    public function getProducts()
    {
        return $this->cartProducts;
    }

    public function deleteItem($itemKey)
    {
        $products = $this->cartProducts;
        unset($products[$itemKey]);
        $this->session->set($this::$cartSessionSection, $products);
    }

    public function updateProductCount($itemKey, $count): int
    {
        $products = $this->cartProducts;
        $products[$itemKey][CartProduct::COUNT] = $count;
        $this->session->set($this::$cartSessionSection, $products);
        return $this->getTotalPrice();
    }
}