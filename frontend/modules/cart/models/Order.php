<?php

namespace frontend\modules\cart\models;

use backend\modules\catalog\models\Order as backendOrder;
use Yii;

class Order extends backendOrder
{
    public function rules()
    {
        return [
            [['comment', 'delivery_address'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'delivery_type'], 'string', 'max' => 255],
            [['total_price'], 'safe'],
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            // Emails
            // $this->sendCallbackToEmail();
            // Trello
            // $this->sendCallbackToTrello();
            // Kaiten
            // $this->sendCallbackToKaiten();
            // Telegram
            $this->sendCallbackTelegram();
            $cart = new Cart();
            $cart->clearCart();
        }
    }

    protected function sendCallbackToEmail()
    {
        $emails = Yii::$app->get('configManager')->getItemValue('contactOrderEmail');
        if ($emails) {
            $emailsArray = explode(",", $emails);
            if ($emailsArray) {
                $this->bulkEmailsFromRecipientsArray($emailsArray);
            } 
        }
    }

    protected function sendCallbackToTrello()
    {
        $emails = Yii::$app->get('configManager')->getItemValue('contactTrello');
        if ($emails) {
            $emailsArray = explode(",", $emails);
            if ($emailsArray) {
                $this->bulkEmailsFromRecipientsArray($emailsArray);
            }  
        }
    }

    protected function sendCallbackToKaiten()
    {
        $emails = Yii::$app->get('configManager')->getItemValue('contactKaiten');
        if ($emails) {
            $emailsArray = explode(",", $emails);
            if ($emailsArray) {
                $this->bulkEmailsFromRecipientsArray($emailsArray);
            }   
        }
        $emailsArray = explode(",", $emails);
        if ($emailsArray) {
            $this->bulkEmailsFromRecipientsArray($emailsArray);
        }
    }

    protected function bulkEmailsFromRecipientsArray($emailsArray)
    {
        foreach ($emailsArray as $email) {
            $this->sendEmail($email);
        }
    }

    protected function getSubject()
    {
        return 'Заказ #' . $this->id;
    }

    protected function sendEmail($email)
    {
        Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['email_from'] => Yii::$app->params['email_from']])
            ->setSubject($this->getSubject())
            ->setTextBody($this->body)
            ->send();
    }

    public function sendCallbackTelegram()
    {
        $chat_id = Yii::$app->get('configManager')->getItemValue('contactTg');
        if (isset($chat_id) && !empty($chat_id)) {
            Yii::$app->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $this->body,
            ]);
        } else {
            return Yii::t('app', "Telegram Chat ID is not set");
        }
        return true;
    }
}