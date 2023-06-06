<?php

namespace frontend\modules\catalog\controllers;

use common\models\Status;
use yii\web\Controller;
use frontend\models\Sections;
use frontend\modules\catalog\models\Product;
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
        $dataProvider = $searchModel->search($queryParams, $productType);
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

    protected function findModel($slug)
    {
        if (($model = Product::findOne(['slug' => $slug, 'status' => Status::STATUS_ACTIVE])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
