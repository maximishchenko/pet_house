<?php

namespace frontend\models;

use backend\modules\catalog\models\items\CatalogTypeItems;
use backend\modules\catalog\models\root\Product;
use yii\base\Model;
use Yii;

class Sections
{
    const SECTION_CHINCHILLES = "/chinchilles";
    const SECTION_DOGS = "/dogs";
    const SECTION_CATS = "/cats";
    const SECTION_BIRDS = "/birds";

    public function __construct()
    {
        $this->url = Yii::$app->request->getUrl();
    }

    public function getSectionName(): ?string
    {
        switch ($this->url) {
            case self::SECTION_CHINCHILLES:
                $this->title = Yii::t('app', "Breadcrumbs Chinchilles");
                break;
            case self::SECTION_DOGS:
                $this->title = Yii::t('app', "Breadcrumbs Dogs");
                break;
            case self::SECTION_CATS:
                $this->title = Yii::t('app', "Breadcrumbs Cats");
                break;
            case self::SECTION_BIRDS:
                $this->title = Yii::t('app', "Breadcrumbs Birds");
                break;
            default:
                $this->title = null;
        }
        return $this->title;
    }
    

    public function getSectionTitle(): ?string
    {
        switch ($this->url) {
            case self::SECTION_CHINCHILLES:
                $this->title = Yii::t('app', "Page Title Chinchilles");
                break;
            case self::SECTION_DOGS:
                $this->title = Yii::t('app', "Page Title Dogs");
                break;
            case self::SECTION_CATS:
                $this->title = Yii::t('app', "Page Title Cats");
                break;
            case self::SECTION_BIRDS:
                $this->title = Yii::t('app', "Page Title Birds");
                break;
            default:
                $this->title = null;
        }
        return $this->title;
    }

    public function setType()
    {
        switch ($this->url) {
            case self::SECTION_CHINCHILLES:
                $type = CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE;
                break;
            case self::SECTION_DOGS:
                $type = CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE;
                break;
        }
        return $type;
    }
}
