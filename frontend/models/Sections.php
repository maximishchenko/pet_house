<?php

namespace frontend\models;

use backend\modules\catalog\models\items\CatalogTypeItems;
use Yii;

class Sections
{
    const SECTION_CHINCHILLES = "/chinchilles";
    const SECTION_DOGS = "/dogs";
    const SECTION_CATS = "/cats";
    const SECTION_BIRDS = "/birds";

    public $url;
    public $title;

    public function __construct()
    {
        $this->url = strtok(Yii::$app->request->getUrl(), '?');
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
    
    /**
     * Раздел хлебных крошек на основании вида продукции
     *
     * @param string $product_type
     * @return void
     */
    public function getProductSectionName($product_type)
    {
        switch ($product_type) {
            case CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE:
                $this->title = Yii::t('app', "Breadcrumbs Chinchilles");
                break;
            case CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE:
                $this->title = Yii::t('app', "Breadcrumbs Dogs");
                break;
            default:
                $this->title = null;
        }
        return $this->title;
    }

    /**
     * Undocumented function
     *
     * @param [type] $product_type
     * @return void
     */
    public function getProductSectionUrl($product_type)
    {
        switch ($product_type) {
            case CatalogTypeItems::PROPERTY_TYPE_RODENT_SHOWCASE:
                $url = self::SECTION_CHINCHILLES;
                break;
            case CatalogTypeItems::PROPERTY_TYPE_DOG_CAGE:
                $url = self::SECTION_DOGS;
                break;
            default:
                $url = null;
        }
        return $url;  
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
