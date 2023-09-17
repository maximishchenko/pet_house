<?php

namespace frontend\modules\cart\models;

use frontend\modules\cart\models\CartSession;
class Cart extends CartSession
{
    public static function getTotalCount(): int
    {
        $cart = new self();
        return count($cart->cartProducts);
    }

    public static function getTotalPrice(): int
    {
        $cart = new self();
        $totalPrice = 0;
        foreach ($cart->cartProducts as $product) {
            $cartItem = new CartProduct();
            $prices = $cartItem->getProductPrice(
                $product[CartProduct::PRODUCT_ID],
                $product[CartProduct::COLOR_ID],
                $product[CartProduct::WALL_ID],
                $product[CartProduct::HEIGHT],
                $product[CartProduct::WIDTH],
                $product[CartProduct::DEPTH],
            );
            $price = $prices['price'];
            $count = $cartItem->getCount($product[CartProduct::PRODUCT_ID]);
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
        $this->session->set($this->cartSessionSection, []);
    }

    public function getProducts()
    {
        return $this->cartProducts;
    }

    public function deleteItem($product_id)
    {
        $products = $this->cartProducts;
        unset($products[$product_id]);
        $this->session->set($this->cartSessionSection, $products);
    }

    public function updateProductCount($product_id, $count): int
    {
        $products = $this->cartProducts;
        $products[$product_id][CartProduct::COUNT] = $count;
        $this->session->set($this->cartSessionSection, $products);
        return $this->getTotalPrice();
    }
}