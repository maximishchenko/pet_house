<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute}}`.
 */
class m230114_122011_create_attribute_table extends Migration
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
        $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'sort' => $this->integer(),
            'status' => $this->string(),
            'product_type' => $this->string(),
            'item_type' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-attribute-id', '{{%attribute}}', 'id');
        $this->createIndex('idx-attribute-name', '{{%attribute}}', 'name');
        $this->createIndex('idx-attribute-value', '{{%attribute}}', 'value');
        $this->createIndex('idx-attribute-sort', '{{%attribute}}', 'sort');
        $this->createIndex('idx-attribute-status', '{{%attribute}}', 'status');
        $this->createIndex('idx-attribute-product_type', '{{%attribute}}', 'product_type');
        $this->createIndex('idx-attribute-item_type', '{{%attribute}}', 'item_type');
        $this->createIndex('idx-attribute-created_at', '{{%attribute}}', 'created_at');
        $this->createIndex('idx-attribute-updated_at', '{{%attribute}}', 'updated_at');
        $this->createIndex('idx-attribute-created_by', '{{%attribute}}', 'created_by');
        $this->createIndex('idx-attribute-updated_by', '{{%attribute}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attribute}}');
    }
}
