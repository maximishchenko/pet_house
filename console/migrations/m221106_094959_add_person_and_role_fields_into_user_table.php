<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m221106_094959_add_person_and_role_fields_into_user_table
 */
class m221106_094959_add_person_and_role_fields_into_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(User::tableName(), 'name', $this->string());
        $this->addColumn(User::tableName(), 'surname', $this->string());
        $this->addColumn(User::tableName(), 'role', $this->string());
        
        $this->createIndex('idx-user-name', User::tableName(), 'name');
        $this->createIndex('idx-user-surname', User::tableName(), 'surname');
        $this->createIndex('idx-user-role', User::tableName(), 'role');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(User::tableName(), 'name');
        $this->dropColumn(User::tableName(), 'surname');
        $this->dropColumn(User::tableName(), 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m221106_094959_add_person_and_role_fields_into_user_table cannot be reverted.\n";

        return false;
    }
    */
}
