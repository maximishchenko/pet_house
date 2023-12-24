<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230927_094446_create_order_table extends Migration
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
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'total_price' => $this->decimal(65,2),
            'comment' => $this->text(),
            'body' => $this->text(),
            'delivery_type' => $this->string(),
            'delivery_address' => $this->text(),
            'created_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-order-id', '{{%order}}', 'id');
        $this->createIndex('idx-order-total_price', '{{%order}}', 'total_price');
        $this->createIndex('idx-order-name', '{{%order}}', 'name');
        $this->createIndex('idx-order-phone', '{{%order}}', 'phone');
        $this->createIndex('idx-order-email', '{{%order}}', 'email');
        $this->createIndex('idx-order-delivery_type', '{{%order}}', 'delivery_type');
        $this->createIndex('idx-order-created_at', '{{%order}}', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
