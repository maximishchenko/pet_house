<?php

namespace frontend\modules\cart\models;

use Yii;

abstract class CartSession
{
    /**
     * Название раздела сессии, описывающего хранилище корзины
     *
     * @var string
     */
    public static $cartSessionSection = 'cart';

    protected $cartProducts;

    /**
     * Объект сессии
     */
    protected $session;
    
    function __construct()
    {
        $this->session = Yii::$app->session;
        $this->createCartSessionStorageIfNotExists();
        $this->cartProducts = $this->session->get($this::$cartSessionSection);
    }

    /**
     * Создает в сессии хранилище корзины при его отсутствии
     *
     * @return void
     */
    protected function createCartSessionStorageIfNotExists()
    {
        $this->openSessionIfNotActive();
        if (!$this->isCartSessionSectionExists()) {
            $this->createEmptyCartSessionStorage();
        }
    }

    /**
     * Открывает сессию, если не открыта
     *
     * @return void
     */
    protected function openSessionIfNotActive()
    {
        if (!$this->session->isActive) {
            $this->session->open();
        }
    }

    /**
     * Проверяет существование раздела сессии, хранящего данные корзины
     *
     * @return boolean
     */
    protected function isCartSessionSectionExists(): bool
    {
        return $this->session->has($this::$cartSessionSection);
    }

    /**
     * Создает пустой раздел сессии для хранения данных корзины
     *
     * @return void
     */
    protected function createEmptyCartSessionStorage()
    {
        $this->session->set($this::$cartSessionSection, []);
    }
    
    /**
     * Удаляет раздел сессии отвечающий за хранение данных корзины
     *
     * @return void
     */
    protected function removeCartSessionStorage()
    {
        $this->session->remove($this::$cartSessionSection);
    }
}