<?php

namespace frontend\modules\catalog\controllers;

use backend\modules\catalog\models\items\ProductItemType;
use backend\modules\catalog\models\items\PropertyItemTypeItems;
use backend\modules\catalog\models\root\Category;
use backend\modules\catalog\models\root\Product as RootProduct;
use backend\modules\catalog\models\root\Property;
use backend\modules\content\models\Question;
use backend\modules\content\models\Review;
use common\models\Status;
use yii\web\Controller;
use frontend\models\Sections;
use frontend\modules\catalog\models\Product;
use frontend\modules\catalog\models\ProductPrice;
use Yii;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
        $this->processPageRequest('page');

        $sections = new Sections();
        $queryParams = $this->request->queryParams;
        $productType = $sections->setType();

        $categories = Category::find()
                        ->where([
                            'status' => Status::STATUS_ACTIVE,
                            'property_type' => $sections->setType(), 
                            'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
                        ])
                        ->all();

        $types = Property::find()
                    ->where([
                        'status' => Status::STATUS_ACTIVE, 
                        'property_type' => $sections->setType(), 
                        'item_type' => PropertyItemTypeItems::PROPERTY_ITEM_TYPE_TYPE
                    ])
                    ->all();

        $heights = Property::find()
                    ->select(['height_value', 'id'])
                    ->where([
                        'status' => Status::STATUS_ACTIVE, 
                        'property_type' => $sections->setType(), 
                        'item_type' => PropertyItemTypeItems::PROPERTY_ITEM_TYPE_SIZE
                    ])
                    ->groupBy(['height_value'])
                    ->all();

        $searchModel = new Product();
        $dataProvider = $searchModel->search($queryParams, $productType, ProductItemType::PRODUCT_TYPE_PRODUCT);



        if (Yii::$app->request->isAjax) {
            $dataProvider->prepare();
            \Yii::$app->response->format = Response::FORMAT_HTML;   
            $response = [
                'totalCount' => $dataProvider->getTotalCount(), 
                'pagesCount' => $dataProvider->pagination->pageCount,
                'content' => $this->renderPartial('//layouts/product/_productLoopAjax', ['dataProvider' => $dataProvider])
            ];
            return Json::encode($response);
            // return $this->renderPartial('//layouts/product/_productLoopAjax', ['dataProvider' => $dataProvider]);
            Yii::$app->end();
        } else {
            return $this->render('index', [
                'sections' => $sections,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'types' => $types,
                'categories' => $categories,
                'heights' => $heights,
            ]);
        }
    }

    public function actionView($slug)
    {
        $sections = new Sections();
        $model = $this->findModel($slug);
        $reviews = Review::find()->where(['status' => Status::STATUS_ACTIVE, 'is_favorite' => false])->all();

        $questions = Question::find()
                    ->where([
                        'status' => Status::STATUS_ACTIVE,
                        'position' => Question::POSITION_CARD
                    ])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all();

        $accessories = RootProduct::find()
                    ->where([
                        'item_type' => ProductItemType::PRODUCT_TYPE_ACCESSORY, 
                        'product_type' => $model->product_type
                    ])
                    ->orderBy(['view_count' => SORT_DESC])
                    ->all();

        return $this->render('product', [
            'model' => $model,
            'questions' => $questions,
            'sections' => $sections,
            'accessories' => $accessories,
            'reviews' => $reviews,
        ]);
    }

    public function actionCalculatePriceConstructor()
    {
        $this->enableCsrfValidation = false;
        if (Yii::$app->request->isAjax) {
            $product_id = Yii::$app->request->get('product_id');
            $color_id = Yii::$app->request->get('color');

            // $size_id = Yii::$app->request->get('size');
            
            $height = Yii::$app->request->get('height');
            $width = Yii::$app->request->get('width');
            $depth = Yii::$app->request->get('depth');
            $walls_id = Yii::$app->request->get('walls');

            // $productPrice = new ProductPrice($product_id, $color_id, $size_id, $walls_id);
            $productPrice = new ProductPrice($product_id, $color_id, $height, $width, $depth, $walls_id);
            
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
    

    protected function processPageRequest($param='page')
    {
        if (Yii::$app->request->isAjax && isset($_POST[$param]))
            $_GET[$param] = Yii::$app->request->post($param);
    }
}
