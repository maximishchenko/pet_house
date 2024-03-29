<?php
namespace frontend\controllers;

use backend\modules\content\models\Review;
use backend\modules\content\models\Slider;
use common\models\Status;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    // Главная
    public function actionIndex()
    {
        $reviews = Review::find()->where(['status' => Status::STATUS_ACTIVE, 'is_favorite' => true])->all();
        $sliders = Slider::find()->where(['status' => Status::STATUS_ACTIVE])->orderBy(['sort' => SORT_DESC])->all();
        return $this->render('index', ['reviews' => $reviews, 'sliders' => $sliders]);
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
    

    public function actionPageNotFound()
    {
        return $this->render('page-not-found');
    }
}
