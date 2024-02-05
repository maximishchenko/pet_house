<?php

namespace backend\modules\catalog\models;

use backend\traits\fileTrait;
use frontend\modules\cart\models\Cart;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $comment
 * @property string|null $delivery_type
 * @property string|null $delivery_address
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{

    use fileTrait;

    public $imagesFiles;

    public $spam_check;

    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'body', 'delivery_address'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'phone', 'email', 'delivery_type'], 'string', 'max' => 255],
            [['total_price', 'imagesFiles', 'spam_check'], 'safe'],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(OrderImage::className(), ['order_id' => 'id']);
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Order Name'),
            'phone' => Yii::t('app', 'Order Phone'),
            'email' => Yii::t('app', 'Order Email'),
            'comment' => Yii::t('app', 'Order Comment'),
            'body' => Yii::t('app', 'Order Body'),
            'delivery_type' => Yii::t('app', 'Delivery Type'),
            'delivery_address' => Yii::t('app', 'Delivery Address'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }


    public static function find()
    {
        return new \backend\modules\catalog\models\query\OrdeQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setProductImageAttribute();
        // Emails
        $this->sendCallbackToEmail();
        // Trello
        $this->sendCallbackToTrello();
        // Kaiten
        $this->sendCallbackToKaiten();
        // Telegram
        $this->sendCallbackTelegram();
        $cart = new Cart();
        $cart->clearCart();

        parent::afterSave($insert, $changedAttributes);
    }


    public function beforeDelete()
    {

        if (parent::beforeDelete()) {
            if ($this->imagesFiles) {
                $this->deleteMultipleFiles('imageFiles', 'image', OrderImage::UPLOAD_PATH);
            }
            return true;
        } else {
            return false;
        }
    }

    protected function setProductImageAttribute()
    {
        $this->imagesFiles = UploadedFile::getInstances($this, 'imagesFiles');
        if (isset($this->imagesFiles) && !empty($this->imagesFiles)) {
            foreach ($this->imagesFiles as $key => $img) {
                $imageModel = new OrderImage();
                $imageModel->imageFile = $img;
                $imageModel->order_id = $this->id;
                $imageModel->save();
                // $imageModel->afterSave();
                foreach ($imageModel->getErrors() as $error) {
                    Yii::error($error);
                }
            }
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
        // $emailsArray = explode(",", $emails);
        // if ($emailsArray) {
        //     $this->bulkEmailsFromRecipientsArray($emailsArray);
        // }
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

    protected function sendCallbackTelegram()
    {
        $chat_id = Yii::$app->get('configManager')->getItemValue('contactTg');
        if (isset($chat_id) && !empty($chat_id)) {
            Yii::$app->telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $this->body,
            ]);
            if (!empty($this->images)) {
                Yii::debug("Has images");
                foreach ($this->images as $image) {
                    Yii::$app->telegram->sendPhoto([
                        'chat_id' => $chat_id,
                        'photo' => Yii::$app->request->hostInfo . '/' . OrderImage::UPLOAD_PATH . $image->image,
                        'caption' => null
                    ]);
                }
            } else {
                Yii::debug("No images");
            }
        } else {
            return Yii::t('app', "Telegram Chat ID is not set");
        }
        return true;
    }
}
