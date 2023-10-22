<?php

namespace frontend\modules\catalog\controllers;

use backend\modules\catalog\models\items\GroupTypeItems;
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


class DefaultController extends Controller
{
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
                            'group_type' => GroupTypeItems::GROUP_TYPE_CATEGORY
                        ])
                        ->all();

        $groups = Category::find()
                        ->where([
                            'status' => Status::STATUS_ACTIVE,
                            'property_type' => $sections->setType(), 
                            'item_type' => ProductItemType::PRODUCT_TYPE_PRODUCT,
                            'group_type' => GroupTypeItems::GROUP_TYPE_GROUP
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
            Yii::$app->end();
        } else {
            return $this->render('index', [
                'sections' => $sections,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'types' => $types,
                'categories' => $categories,
                'groups' => $groups,
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
            $color_id = Yii::$app->request->get('color_id');
            $wall_id = Yii::$app->request->get('wall_id');
            
            $heightPrice = Yii::$app->request->get('heightPrice');
            $widthPrice = Yii::$app->request->get('widthPrice');
            $depthPrice = Yii::$app->request->get('depthPrice');

            $startStepHeightValue = Yii::$app->request->get('start-step-height');
            $currentStepHeightValue = Yii::$app->request->get('current-step-height');
            $minStepHeightValue = Yii::$app->request->get('minimal-step-height');
            $stepPriceHeightValue = Yii::$app->request->get('step-price-height');
            
            $startStepWidthValue = Yii::$app->request->get('start-step-width');
            $currentStepWidthValue = Yii::$app->request->get('current-step-width');
            $minStepWidthValue = Yii::$app->request->get('minimal-step-width');
            $stepPriceWidthValue = Yii::$app->request->get('step-price-width');
            
            $startStepDepthValue = Yii::$app->request->get('start-step-depth');
            $currentStepDepthValue = Yii::$app->request->get('current-step-depth');
            $minStepDepthValue = Yii::$app->request->get('minimal-step-depth');
            $stepPriceDepthValue = Yii::$app->request->get('step-price-depth');

            $stepSizeValue = Yii::$app->request->get('step-size');

            $productPrice = new ProductPrice(
                $product_id, $color_id, $wall_id, $heightPrice, $widthPrice, $depthPrice,
                $startStepHeightValue, $currentStepHeightValue, $minStepHeightValue, $stepPriceHeightValue,
                $startStepWidthValue, $currentStepWidthValue, $minStepWidthValue, $stepPriceWidthValue,
                $startStepDepthValue, $currentStepDepthValue, $minStepDepthValue, $stepPriceDepthValue,
                $stepSizeValue
            );
            
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
