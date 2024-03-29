<?php

namespace backend\modules\catalog\controllers;

use Yii;
use backend\modules\catalog\models\DogCageProduct;
use backend\modules\catalog\models\ProductImage;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\search\DogCageProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RodentProductController implements the CRUD actions for RodentProduct model.
 */
class DogCageProductController extends Controller
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

    /**
     * Lists all RodentProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DogCageProductSearch();
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
        $model = new DogCageProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = DogCageProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
}
