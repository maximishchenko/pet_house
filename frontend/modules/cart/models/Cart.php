<?php

namespace frontend\modules\cart\models;

use frontend\modules\cart\interfaces\CartInterface;
use frontend\modules\cart\models\CartSession;

/**
 * ~~~
 * $_SESSION['cart'] = [
 *  [$id] => [
 *      
 *  ],
 *  [1] => [
 * 
 *  ],
 *  [...] => [
 * 
 *  ],
 *  [N] => [
 * 
 *  ],
 * ];
 * ~~~
 */
class Cart extends CartSession implements CartInterface
{
    
    public function getItems()
    {

    }

    /**
     * Возвращает количество элементов в корзине
     *
     * @return integer
     */
    public function getCount(): int
    {
        return 0;
    }

    public function getTotalCost(): float
    {
        return 0;
    }

    public function getItem(int $id)
    {

    }

    public function getPrice(int $id): float
    {
        return 1000;
    }

    public function getOldPrice(int $id): ?float
    {
        return 2000;
    }

    public function getDiscount(int $id): ?int
    {

    }

    public function addItem(int $id, int $quantity = 1, $params = [])
    {

    }

    public function changeCount(int $id, int $quantity)
    {

    }

    public function deleteItem(int $id)
    {

    }

    /**
     * Очистка корзины
     *
     * @return void
     */
    public function clear()
    {
        $this->removeCartSessionStorage();
    }

    protected function findItem($id)
    {

    }

    protected function checkItemIsProduct($id)
    {

    }

    protected function checkItemIsAccessory($id)
    {

    }
}