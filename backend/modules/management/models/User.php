<?php

namespace backend\modules\management\models;

use common\models\User as commonUser;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $role
 */
class User extends commonUser
{

    public $newPassword;

    public $repeatPassword;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * Возвращает массив статусов пользователей
     *
     * @return array
     */
    public static function getStatusesArray(): array
    {
        return [
            static::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            static::STATUS_INACTIVE => Yii::t('app', 'STATUS_BLOCKED'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'name', 'surname', 'role'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'User Name'),
            'surname' => Yii::t('app', 'User Surname'),
            'role' => Yii::t('app', 'User Role'),
            'newPassword' => Yii::t('app', 'New Password'),
            'repeatPassword' => Yii::t('app', 'Repeat Password'),
            'fullName' => Yii::t('app', 'Full Name'),
        ];
    }
}
