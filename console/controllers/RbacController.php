<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;
use common\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }


        $auth = Yii::$app->authManager;
        $auth->removeAll(); 
        $auth->removeAll();

        $rule = new UserRoleRule();
        $auth->add($rule);

        // Admin
        $admin = $auth->createRole(User::ROLE_ADMIN);
        $admin->description = Yii::t('app', 'ROLE_ADMIN_DESCRIPTION');
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        // Dev
        $dev = $auth->createRole(User::ROLE_DEV);
        $dev->description = Yii::t('app', 'ROLE_DEV_DESCRIPTION');
        $dev->ruleName = $rule->name;        
        $auth->add($dev);
        $auth->addChild($dev, $admin);
    }
}