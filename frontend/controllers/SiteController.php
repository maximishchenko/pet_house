<?php
namespace frontend\controllers;

use backend\modules\content\models\Review;
use common\models\Status;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    // Главная
    public function actionIndex()
    {
        $reviews = Review::find()->where(['status' => Status::STATUS_ACTIVE, 'is_favorite' => true])->all();
        return $this->render('index', ['reviews' => $reviews]);
    }

    // Политика конфиденциальности
    public function actionPrivacy()
    {
        $settings = Yii::$app->get('configManager');
        return $this->render('privacy', ['settings' => $settings]);
    }

    // Доставка и оплата
    public function actionDelivery()
    {
        return $this->render('delivery');
    }
}
