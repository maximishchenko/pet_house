<?php

namespace frontend\modules\seo\models;

use backend\modules\seo\models\MetaTag as backendMetaTag;
use common\models\Status;
use Yii;

class MetaTag extends backendMetaTag
{
    const TITLE = 'title';

    const DESCRIPTION = 'description';

    const KEYWORDS = 'keywords';

    const OG_TITLE = 'og:title';

    const OG_DESCRIPTION = 'og:description';

    const OG_TYPE = 'og:type';

    const OG_SITENAME = 'og:sitename';

    const OG_IMAGE = 'og:image';

    const OG_URL = 'og:url';

    const DEFAULT_DESCRIPTION_TEXT = "Каталог витрин-клеток для шиншилл, дегу, хорьков и других грызунов. Доставка по России.";
    
    const DEFAULT_KEYWORDS_TEXT = "клетка витрина для шиншиллы, клетка витрина для шиншиллы купить, клетка витрина для шиншиллы купить с доставкой, витрина для шиншиллы, клетка витрина для шиншиллы Россия, витрина для шиншиллы купить, клетка витрина для дегу, клетка витрина для дегу купить";

    public static function setDefaultMetaTags(): array
    {
        return [
            self::DESCRIPTION => self::DEFAULT_DESCRIPTION_TEXT,
            self::KEYWORDS => self::DEFAULT_KEYWORDS_TEXT,
        ];
    }


    public static function setMetaTag($tag)
    {
        $seoTags = self::find()
            ->where([
                'status' => Status::STATUS_ACTIVE,
                'url' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
            ])
            ->one();

        if ($seoTags !== null) {   
            $properties = array_keys(self::getPagePropertiesArray());
            foreach($properties as $tag) {
                if(static::validateSeoTag($tag)) {
                    $property = self::getPagePropertiesArray()[$tag];
        
                    if (isset($seoTags->$property) && !empty($seoTags->$property)) {
                        if ($tag === self::TITLE) {
                            Yii::$app->view->title = $seoTags->meta_title;
                        } else {
                            Yii::$app->view->registerMetaTag([
                                'name' => $tag,
                                'content' => $seoTags->$property,
                            ], $tag);
                        }
                    }
                }
            }
        } else {
            if (!isset(Yii::$app->view->title) && empty(Yii::$app->view->title)) {
                Yii::$app->view->title = Yii::$app->request->hostInfo;
            }
            foreach (self::setDefaultMetaTags() as $tagName => $tagValue) {
                Yii::$app->view->registerMetaTag([
                    'name' => $tagName,
                    'content' => $tagValue,
                ], $tagName);
            }
        }

    }

    protected static function validateSeoTag($tag)
    {
        return (in_array($tag, array_keys(static::getPagePropertiesArray()))) ? true : false;
    }

    public static function getPagePropertiesArray()
    {
        return [
            static::TITLE => 'meta_title',
            static::DESCRIPTION => 'meta_description',
            static::KEYWORDS => 'meta_keywords',
            static::OG_TITLE => 'og_title',
            static::OG_DESCRIPTION => 'og_description',
            static::OG_IMAGE => 'og_image',
            static::OG_SITENAME => 'og_sitename',
            static::OG_TYPE => 'og_type',
            static::OG_URL => 'og_url',
        ];
    }
}