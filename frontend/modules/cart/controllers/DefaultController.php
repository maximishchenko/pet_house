<?php

namespace frontend\modules\cart\controllers;

use common\components\Word;
use frontend\modules\cart\models\Cart;
use frontend\modules\cart\models\CartProduct;
use frontend\modules\cart\models\CartSession;
use frontend\modules\cart\models\Order;
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
        if (Yii::$app->request->isAjax) {
            $productsSession = $this->getProductsSession();
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

            $flag = false;
            for ($i = 0; $i < count($productsSession); $i++) {
                if (
                    $productsSession[$i][CartProduct::PRODUCT_ID] === $cart->product_id &&
                    $productsSession[$i][CartProduct::COLOR_ID] === $cart->color_id &&
                    $productsSession[$i][CartProduct::WALL_ID] === $cart->walls_id &&
                    $productsSession[$i][CartProduct::HEIGHT] === $cart->height &&
                    $productsSession[$i][CartProduct::WIDTH] === $cart->width &&
                    $productsSession[$i][CartProduct::DEPTH] === $cart->depth &&
                    $productsSession[$i][CartProduct::PRICE] === $cart->price &&
                    $productsSession[$i][CartProduct::OLD_PRICE] === $cart->old_price
                ) {
                    $flag = true;
                    $productsSession[$i][CartProduct::COUNT] = $productsSession[$i][CartProduct::COUNT] + 1;

                    $countCurrentProduct = $productsSession[$i][CartProduct::COUNT];
                }
            }
            if (!$flag) {
                array_push($productsSession, [
                    CartProduct::PRODUCT_ID => $cart->product_id,
                    CartProduct::COLOR_ID => $cart->color_id,
                    CartProduct::WALL_ID => $cart->walls_id,
                    CartProduct::HEIGHT => $cart->height,
                    CartProduct::WIDTH => $cart->width,
                    CartProduct::DEPTH => $cart->depth,
                    CartProduct::PRICE => $cart->price,
                    CartProduct::OLD_PRICE => $cart->old_price,
                    CartProduct::COUNT => $cart->count,
                ]);

                $countCurrentProduct = $cart->count;
            }
            $totalPriceCurrentProduct = $countCurrentProduct * $productsSession[$i][CartProduct::PRICE];

            Yii::$app->session->set(Cart::$cartSessionSection, $productsSession);

            $lastProductNameWithImage = $cart->getProductNameWithImage($cart->product_id);
            $lastProductInCart = [
                CartProduct::PRODUCT_ID => $cart->product_id,
                CartProduct::NAME => $lastProductNameWithImage[CartProduct::NAME],
                CartProduct::IMAGE => $lastProductNameWithImage[CartProduct::IMAGE],
                CartProduct::PRICE => $cart->price,
                CartProduct::TOTAL_PRICE => Cart::getTotalPrice(),
                CartProduct::COUNT => $cart->getCount($cart->product_id),
                'total_count_per_one_product_with_words' => Word::numWord(Cart::getTotalCount(), ['товар', 'товара', 'товаров']),
                'total_count_per_one_product' => $countCurrentProduct,
                'total_price_per_one_product' => $totalPriceCurrentProduct,
                CartProduct::TOTAL_COUNT => Cart::getTotalCount(),
            ];
            return json_encode($lastProductInCart);
        }
        Yii::$app->end();
    }


    public function actionClearCart()
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isAjax) {
            $cart = new Cart();
            $cart->clearCart();
        }
        Yii::$app->end();
    }

    public function actionGetTotalCount()
    {
        $cart = new Cart();
        return $cart->getTotalCount();
    }

    public function actionDeleteItem($itemKey)
    {
        $cart = new Cart();
        $cart->deleteItem($itemKey);
        return $this->redirect("/cart");
    }

    public function actionUpdateProductCount($itemKey, $count)
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isAjax) {
            $cart = new Cart();
            return json_encode($cart->updateProductCount($itemKey, $count));
        }
        Yii::$app->end();
    }

    protected function getProductsSession()
    {
        if (Yii::$app->session->has(CartSession::$cartSessionSection)) {
            $productsSession = Yii::$app->session->get(CartSession::$cartSessionSection);
        } else {
            $productsSession = [];
        }
        return $productsSession;
    }
}
