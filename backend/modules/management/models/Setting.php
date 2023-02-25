<?php

namespace backend\modules\management\models;

use Yii;

/**
 * This is the model class for table "{{%setting}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $key
 * @property string|null $value
 * @property string|null $field_type
 * @property string|null $tab
 */
class Setting extends \yii\base\Model
{

    const TAB_CONTACT = 'contact';
    const TAB_SEO = 'seo';
    const TAB_SERVICES = 'services';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%setting}}';
    }

    public static function getTabsArray(): array
    {
        return [
            self::TAB_CONTACT => Yii::t('app', 'SETTING_CONTACT_TAB'),
            self::TAB_SERVICES => Yii::t('app', 'SETTING_SERVICES_TAB'),
            self::TAB_SEO => Yii::t('app', 'SETTING_SEO_TAB'),
        ];
    }

    /**
     * Сопоставление пунктов настроек вкладкам
     *
     * @return array
     */
    public static function getTabsItems(): array
    {
        return [
            self::TAB_CONTACT => [
                'phone', 'email', 'telegram', 'whatsapp', 'vk', 'instagram', 'avito', 'livemaster', 'ozon', 'address', 'requisites',
            ],
            self::TAB_SERVICES => [
                'mapLink',
            ],
            self::TAB_SEO => [
                'seo_keywords', 'seo_description',
            ],
        ];
    }
}
