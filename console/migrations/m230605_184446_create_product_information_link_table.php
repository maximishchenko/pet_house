<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_information_link}}`.
 */
class m230605_184446_create_product_information_link_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%product_information_link}}', [
            'product_id' => $this->integer()->notNull(),
            'information_item_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('pk-product_information_link', '{{%product_information_link}}', ['product_id', 'information_item_id']);

        $this->createIndex('idx-product_information_link-product_id', '{{%product_information_link}}', 'product_id');
        $this->createIndex('idx-product_information_link-information_item_id', '{{%product_information_link}}', 'information_item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_information_link}}');
    }
}
