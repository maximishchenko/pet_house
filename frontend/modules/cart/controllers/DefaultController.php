<?php

namespace frontend\modules\cart\controllers;

use backend\modules\catalog\models\root\Property;
use common\components\Word;
use frontend\modules\cart\models\Cart;
use frontend\modules\cart\models\CartProduct;
use frontend\modules\cart\models\CartSession;
use frontend\modules\cart\models\Order;
use frontend\modules\catalog\models\Product;
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

    public function actionOrder()
    {
        $model = new Order();
        if ($model->load(Yii::$app->request->post())) {
            $name = $model->name;
            $phone = $model->phone;
            $email = $model->email;
            // $delivery_type = $model->delivery_type;
            $delivery_address = $model->delivery_address;
            $comment = $model->comment;

            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);
            $phone = str_replace(' ', '', $phone);
            $phone = str_replace('-', '', $phone);

            $body = "";
            $body .= "Ф.И.О.: " . $name . PHP_EOL;
            $body .= "Тел.: " . $phone . PHP_EOL;
            $body .= "Email.: " . $email . PHP_EOL;
            // $body .= "Тип получения товара: " . $delivery_type . PHP_EOL;
            $body .= "Адрес: " . $delivery_address . PHP_EOL;
            $body .= "Комментарий: " . $comment . PHP_EOL;
            $body .= PHP_EOL;
            $cart = new Cart();
            $price = 0;
            foreach ($cart->getProducts() as $k => $product) {
                $productType = Product::findOne(['id' => $product[CartProduct::PRODUCT_ID]]);
                $color = Property::findOne(['id' => $product[CartProduct::COLOR_ID]]);
                $wall = Property::findOne(['id' => $product[CartProduct::WALL_ID]]);

                $body .= "Наименование: " . $productType->name . PHP_EOL;
                if ($color->name) :
                    $body .= "Цвет: " . $color->name . PHP_EOL;
                endif;
                if ($product[CartProduct::HEIGHT] && $product[CartProduct::WIDTH] && $product[CartProduct::DEPTH]) :
                    $body .= "Размеры: " . $product[CartProduct::HEIGHT] . "x" . $product[CartProduct::WIDTH] . "x" . $product[CartProduct::DEPTH] . PHP_EOL;
                endif;
                if ($wall->name) :
                    $body .= "Боковые стенки: " . $wall->name . PHP_EOL;
                endif;
                $body .= "Количество: " . $product[CartProduct::COUNT] . PHP_EOL;
                $body .= "Цена: " . $product[CartProduct::PRICE] . PHP_EOL;
                $body .= "Сумма: " . $product[CartProduct::PRICE] * $product[CartProduct::COUNT] . PHP_EOL;
                $body .= PHP_EOL;
                $price += $product[CartProduct::PRICE] * $product[CartProduct::COUNT];
            }

            $body .= "Общая сумма заказа: " . $price . PHP_EOL;
            $model->body = $body;
            $model->total_price = $price;
            $model->save();
            return $this->redirect('/cart?success=1');
            // return $this->redirect(Yii::$app->request->referrer);
        } else {
            die(print_r($model->getErrors()));
        }
        Yii::$app->end();
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
                    $itemKey = $i;
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

                $itemKey = max(array_keys($productsSession));

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
                'itemKey' => $itemKey,
                CartProduct::TOTAL_COUNT => Cart::getTotalCount(),
            ];
            return json_encode($lastProductInCart);
        }
        Yii::$app->end();
    }


    public function actionClearCart()
    {
        $this->enableCsrfValidation = false;
        // if (Yii::$app->request->isAjax) {
        $cart = new Cart();
        $cart->clearCart();
        // }
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
