<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_attribute_link}}`.
 */
class m230604_131734_create_product_attribute_link_table extends Migration
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
        $this->createTable('{{%product_attribute_link}}', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'product_type' => $this->string()->notNull(),
            'item_type' => $this->string()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('pk-product_attribute_link', '{{%product_attribute_link}}', ['product_id', 'attribute_id']);

        $this->createIndex('idx-product_attribute_link-product_id', '{{%product_attribute_link}}', 'product_id');
        $this->createIndex('idx-product_attribute_link-attribute_id', '{{%product_attribute_link}}', 'attribute_id');
        $this->createIndex('idx-product_attribute_link-product_type', '{{%product_attribute_link}}', 'product_type');
        $this->createIndex('idx-product_attribute_link-item_type', '{{%product_attribute_link}}', 'item_type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_attribute_link}}');
    }
}
