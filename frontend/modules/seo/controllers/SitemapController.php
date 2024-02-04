<?php

namespace frontend\modules\seo\controllers;

use backend\modules\catalog\models\items\CatalogTypeItems;
use common\models\Status;
use frontend\modules\catalog\models\Product;
use Yii;
use yii\web\Response;
use yii2tech\sitemap\File;
use yii\web\Controller;

// TODO crete sitemap rules
class SitemapController extends Controller
{
    public function actionIndex()
    {
        // get content from cache:
        $content = Yii::$app->cache->get('sitemap.xml');
        if ($content === false) {
            // if no cached value exists - create an new one
            // create sitemap file in memory:
            $sitemap = new File();
            $sitemap->fileName = 'php://memory';

                    
            // write your site URLs:
            $sitemap->writeUrl(['cart/default/index'], ['priority' => '0.9']);
            $sitemap->writeUrl(['site/privacy'], ['priority' => '0.9']);
            $sitemap->writeUrl(['site/delivery'], ['priority' => '0.9']);
            $sitemap->writeUrl(['/dogs'], ['priority' => '0.9']);
            $sitemap->writeUrl(['/chinchilles'], ['priority' => '0.9']);

            $dogs = Product::getDb()->cache(function() {
                return Product::find()->where(['status' => Status::STATUS_ACTIVE, 'product_type' => CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE, ])->all();
            });
            foreach ($dogs as $dog) {
                $sitemap->writeUrl(['dogs/' . $dog->slug], ['priority' => '0.9']);
            }

            $chinchilles = Product::getDb()->cache(function() {
                return Product::find()->where(['status' => Status::STATUS_ACTIVE, 'product_type' => CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE, ])->all();
            });
            foreach ($chinchilles as $chinchille) {
                $sitemap->writeUrl(['chinchilles/' . $chinchille->slug], ['priority' => '0.9']);
            }
            
            // get generated content:
            $content = $sitemap->getContent();
        
            // save generated content to cache
            Yii::$app->cache->set('sitemap.xml', $content);
        }
        
        // send sitemap content to the user agent:
        $response = Yii::$app->getResponse();
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->add('Content-Type', 'application/xml;');
        $response->content = $content;
                
        return $response;
    }
}