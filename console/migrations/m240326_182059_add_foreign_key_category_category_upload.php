<?php

use yii\db\Migration;

/**
 * Class m240326_182059_add_foreign_key_category_category_upload
 */
class m240326_182059_add_foreign_key_category_category_upload extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-category_upload-category', '{{%category_upload}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
        $this->dropForeignKey('fk-category_upload-category', '{{%category_upload}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240326_182059_add_foreign_key_category_category_upload cannot be reverted.\n";

        return false;
    }
    */
}
