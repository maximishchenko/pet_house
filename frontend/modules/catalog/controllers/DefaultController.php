<?php

namespace frontend\modules\catalog\controllers;

use backend\modules\catalog\models\items\ProductItemType;
use common\models\Status;
use yii\web\Controller;
use frontend\models\Sections;
use frontend\modules\catalog\models\Product;
use frontend\modules\catalog\models\ProductPrice;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `catalog` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $sections = new Sections();
        $queryParams = $this->request->queryParams;
        $productType = $sections->setType();

        $searchModel = new Product();
        $dataProvider = $searchModel->search($queryParams, $productType, ProductItemType::PRODUCT_TYPE_PRODUCT);
        return $this->render('index', [
            'sections' => $sections,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        $model = $this->findModel($slug);
        return $this->render('product', ['model' => $model]);
    }

    public function actionCalculatePriceConstructor()
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isAjax) {
            $product_id = Yii::$app->request->get('product_id');
            $color_id = Yii::$app->request->get('color');
            $size_id = Yii::$app->request->get('size');
            $walls_id = Yii::$app->request->get('walls');

            $productPrice = new ProductPrice($product_id, $color_id, $size_id, $walls_id);
            
            $data = json_encode($productPrice->getPriceValues());
            return $data;
        }
        Yii::$app->end();

    }

    protected function findModel($slug)
    {
        if (($model = Product::findOne(['slug' => $slug, 'status' => Status::STATUS_ACTIVE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
