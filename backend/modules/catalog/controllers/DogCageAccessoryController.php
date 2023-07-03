<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\models\ProductImage;
use Yii;
use backend\modules\catalog\models\DogCageAccessory;
use backend\modules\catalog\models\root\Product;
use backend\modules\catalog\models\search\DogCageAccessorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DogCageAccessoryController extends Controller
{
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

    public function actionIndex()
    {
        $searchModel = new DogCageAccessorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new DogCageAccessory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Record added'));
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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

    protected function findModel($id)
    {
        if (($model = DogCageAccessory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
