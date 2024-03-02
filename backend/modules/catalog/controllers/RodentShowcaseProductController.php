<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\models\ProductAccessoryLink;
use backend\modules\catalog\models\ProductImage;
use Yii;
use backend\modules\catalog\models\RodentShowcaseProduct;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\search\RodentShowcaseProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use himiklab\sortablegrid\SortableGridAction;


/**
 * RodentProductController implements the CRUD actions for RodentProduct model.
 */
class RodentShowcaseProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    // public function actions()
    // {
    //     return [
    //         'sort' => [
    //             'class' => SortableGridAction::className(),
    //             'modelName' => RodentShowcaseProduct::className(),
    //         ],
    //     ];
    // }

    /**
     * Lists all RodentProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RodentShowcaseProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new RodentProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RodentShowcaseProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RodentProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {    
            Yii::$app->session->setFlash('info', Yii::t('app', 'Record changed'));
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RodentProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->delete()){
            Yii::$app->session->setFlash('warning', Yii::t('app', 'Record deleted'));
        } else {
            Yii::$app->session->setFlash('error', $model->getErrorSummary(true));
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteImage(int $id)
    {
        $model = $this->findModel($id);
        $file = $model->getPath(Product::UPLOAD_PATH, $model->image);
        $model->removeSingleFileIfExist($file);
        $model->image = null;
        $model->save();
        Yii::$app->session->setFlash('danger', 'Запись удалена!');
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteImages(int $id)
    {
        $model = ProductImage::findOne($id);
        if ($model != null) {
            $file = $model->getPath(Product::UPLOAD_PATH, $model->image);
            $model->removeSingleFileIfExist($file);
            $model->delete();
            Yii::$app->session->setFlash('danger', 'Запись удалена!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionDeleteAllImages($id)
    {
        $images = ProductImage::find()->where(['product_id' => $id])->all();
        foreach ($images as $image) {
            $image->delete();
        }
        Yii::$app->session->setFlash('warning', Yii::t('app', 'All Images deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    
    /**
     * Drag'n'Drop сортировка изображений
     */
    public function actionSaveImageSort()
    {
        $order = Yii::$app->request->post('order');
        foreach($order as $sort => $imageId) {
            if(isset($imageId) && !empty($imageId)) {
                $image = ProductImage::findOne($imageId);
                $image->sort = $sort;
                $image->save();
            }
        }
        print_r($order);
    }

    /**
     * Список аксессуаров для товара
     *
     * @param [type] $id
     * @return void
     */
    public function actionAccessories($id)
    {
        $productModel = $this->findModel($id);
        return $this->render('accessories', ['model' => $productModel]);
    }

    public function actionAddAccessory($id)
    {
        $productModel = $this->findModel($id);

        $accessoryModel = new ProductAccessoryLink();
        $accessoryModel->product_id = $productModel->id;
        $accessoryModel->product_type = $productModel->product_type;

        if ($accessoryModel->load(Yii::$app->request->post()) && $accessoryModel->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Accessory Record added'));
            return $this->redirect(['accessories', 'id' => $productModel->id]);
        }

        return $this->render('add-accessory', ['model' => $productModel, 'accessoryModel' => $accessoryModel]);
    }

    public function actionDeleteAccessory($product_id, $accessory_id)
    {
        $productAccessory = ProductAccessoryLink::findOne(['product_id' => $product_id, 'accessory_id' => $accessory_id]);
        if ($productAccessory !== null)
        {
            $productAccessory->delete();
            Yii::$app->session->setFlash('success', Yii::t('app', 'Accessory Record deleted'));
            return $this->redirect(Yii::$app->request->referrer);
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the RodentShowcaseProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RodentShowcaseProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RodentShowcaseProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
