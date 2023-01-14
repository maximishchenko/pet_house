<?php

namespace common\components\i18n;

use Yii;

class SwitchLanguage
{
        
    public static function onLanguageChanged($event)
    {
        // $event->language: new language
        // $event->oldLanguage: old language

        // Save the current language to user record
        $user = Yii::$app->user;
        if (!$user->isGuest) {
            $user->identity->language = $event->language;
            $user->identity->save();
        }
    }
}