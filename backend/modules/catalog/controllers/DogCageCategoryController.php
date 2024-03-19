<?php

namespace backend\modules\catalog\controllers;

use backend\modules\catalog\models\root\CategoryUpload;
use Yii;
use backend\modules\catalog\models\DogCageCategory;
use backend\modules\catalog\models\search\DogCageCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DogCageCategoryController implements the CRUD actions for DogCageCategory model.
 */
class DogCageCategoryController extends Controller
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
     * Lists all RodentShowcaseCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DogCageCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new RodentShowcaseCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DogCageCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RodentShowcaseCategory model.
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
     * Deletes an existing RodentShowcaseCategory model.
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
    

    public function actionDeleteAllFiles($id)
    {
        $images = CategoryUpload::find()->where(['category_id' => $id])->all();
        foreach ($images as $image) {
            $image->delete();
        }
        Yii::$app->session->setFlash('warning', Yii::t('app', 'All Images deleted'));
        return $this->redirect(Yii::$app->request->referrer);
    }
    
    public function actionDeleteFile(int $id)
    {
        $model = CategoryUpload::findOne($id);
        if ($model != null) {
            $file = $model->getPath(CategoryUpload::UPLOAD_PATH, $model->file_path);
            $file_preview = $model->getPath(CategoryUpload::PREVIEW_UPLOAD_PATH, $model->file_path);
            $model->removeSingleFileIfExist($file_preview);
            $model->removeSingleFileIfExist($file);
            $model->delete();
            Yii::$app->session->setFlash('danger', 'Запись удалена!');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    
    /**
     * Drag'n'Drop сортировка изображений
     */
    public function actionSaveImageSort()
    {
        $order = Yii::$app->request->post('order');
        foreach($order as $sort => $fileId) {
            if(isset($fileId) && !empty($fileId)) {
                $image = CategoryUpload::findOne($fileId);
                $image->sort = $sort;
                $image->save();
            }
        }
        print_r($order);
    }

    /**
     * Finds the RodentShowcaseCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RodentShowcaseCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DogCageCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
