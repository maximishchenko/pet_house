<?php
namespace common\components\rbac;
use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;
class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            $role = $user->role;
            if ($item->name === User::ROLE_DEV) {
                return $role == User::ROLE_DEV;
            } 
            elseif ($item->name === User::ROLE_ADMIN) {
                return $role == User::ROLE_DEV || $role == User::ROLE_ADMIN;
            }
        }

        return false;
    }
}