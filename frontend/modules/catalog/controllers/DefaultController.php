<?php

namespace frontend\modules\catalog\controllers;

use yii\web\Controller;
use frontend\models\Sections;

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
        return $this->render('index', ['sections' => $sections]);
    }

    public function actionView()
    {
        return $this->render('product', []);
    }
}
