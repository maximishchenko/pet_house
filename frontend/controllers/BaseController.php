<?php

namespace frontend\controllers;

use common\models\Core;
use frontend\models\Redirect;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {

        if (($exception = Yii::$app->getErrorHandler()->exception) && $exception->statusCode === 404) {
            return $this->response->redirect(['/page-not-found'])->send();
        }
        return parent::beforeAction($action);
    }
}