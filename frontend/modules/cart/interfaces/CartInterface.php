<?php

namespace frontend\modules\cart\interfaces;

interface CartInterface
{

    public function getItems();

    public function getCount();

    public function getTotalCost();

    public function getItem(int $id);

    public function getItemPrice(int $id): float;

    public function getItemOldPrice(int $id): float;

    public function getItemDiscount(int $id): int;

    public function addItem(int $id, int $quantity = 1, array $params = []);

    public function changeItemCount(int $id, int $quantity);

    public function deleteItem(int $id);

    public function clearItems();
}