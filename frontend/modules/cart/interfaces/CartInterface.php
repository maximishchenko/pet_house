<?php

namespace frontend\modules\cart\interfaces;

interface CartInterface
{

    public function getProducts();

    public function getCount();

    public function getProduct(int $product_id);

    public function getProductPrice(int $product_id): float;

    public function getProductOldPrice(int $product_id): float;

    public function getDiscount(int $id): ?int;

    public function getTotalCost();

    public function addItem(int $id, int $quantity = 1, $params = []);

    public function changeCount(int $id, int $quantity);

    public function deleteItem(int $id);

    public function clear();
}