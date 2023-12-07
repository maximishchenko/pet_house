<?php

namespace frontend\modules\cart\controllers;

use common\components\Word;
use frontend\modules\cart\models\Cart;
use frontend\modules\cart\models\CartProduct;
use frontend\modules\cart\models\Order;
use frontend\modules\catalog\models\ProductPrice;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `cart` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $cart = new Cart();
        $order = new Order();
    
        if ($order->load(Yii::$app->request->post()) && $order->save()) {
            // TODO clear cart
            // TODO add product_items
            return $this->refresh();
        }

        return $this->render('index', [
            'cart' => $cart,
            'order' => $order,
        ]);
    }

    public function actionAddToCart()
    {
        $this->enableCsrfValidation = false;
        // if (Yii::$app->request->isAjax) {

            $cart = new CartProduct();
            $cart->product_id = Yii::$app->request->get('product_id');
            $cart->color_id = Yii::$app->request->get('color');
            $cart->walls_id = Yii::$app->request->get('walls');
            $cart->height = Yii::$app->request->get('height');
            $cart->width = Yii::$app->request->get('width');
            $cart->depth = Yii::$app->request->get('depth');
            $cart->price = Yii::$app->request->get('price');
            $cart->old_price = Yii::$app->request->get('old_price');
            $cart->count = 1;
            $cart->addToCart();
            // name, image, price, totalprice, count
            $lastProductNameWithImage = $cart->getProductNameWithImage($cart->product_id);
            $lastProductInCart = [
                'product_id' => $cart->product_id,
                'name' => $lastProductNameWithImage[CartProduct::NAME],
                'image' => $lastProductNameWithImage[CartProduct::IMAGE],
                'price' => $cart->price,
                // 'price' => $cart->getProductPrice($cart->product_id, $cart->color_id, $cart->walls_id, $cart->height, $cart->width, $cart->depth),
                'total_price' => Cart::getTotalPrice(),
                'count' => $cart->getCount($cart->product_id),
                'total_count' => Word::numWord($cart->getCount($cart->product_id), ['товар', 'товара', 'товаров']),
            ];
            return json_encode($lastProductInCart);
            Yii::$app->end();
        // }
    }

    public function actionClearCart()
    {
        // $this->enableCsrfValidation = false;
        // if (Yii::$app->request->isAjax) {
            $cart = new Cart();
            $cart->clearCart();
        // }
        // Yii::$app->end();
    }

    public function actionGetTotalCount()
    {
        $cart = new Cart();
        return $cart->getTotalCount();
    }

    public function actionDeleteItem($product_id)
    {
        $cart = new Cart();
        $cart->deleteItem($product_id);
        return $this->redirect("/cart");
    }

    public function actionUpdateProductCount($product_id, $count)
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isAjax) {
            $cart = new Cart();
            return $cart->updateProductCount($product_id, $count);
        }
        Yii::$app->end();
    }
}
