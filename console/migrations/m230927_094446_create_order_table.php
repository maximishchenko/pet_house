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
            'image' => $this->string(),
            'comment' => $this->text(),
            'delivery_type' => $this->string(),
            'delivery_address' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-order-id', '{{%order}}', 'id');
        $this->createIndex('idx-order-name', '{{%order}}', 'name');
        $this->createIndex('idx-order-image', '{{%order}}', 'image');
        $this->createIndex('idx-order-phone', '{{%order}}', 'phone');
        $this->createIndex('idx-order-email', '{{%order}}', 'email');
        $this->createIndex('idx-order-delivery_type', '{{%order}}', 'delivery_type');
        $this->createIndex('idx-order-created_at', '{{%order}}', 'created_at');
        $this->createIndex('idx-order-updated_at', '{{%order}}', 'updated_at');
        
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->text(),
            'height' => $this->decimal(65.2),
            'width' => $this->decimal(65.2),
            'depth' => $this->decimal(65.2),
            'wall_id' => $this->integer(),
            'color_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-order_item-id', '{{%order_item}}', 'id');
        $this->createIndex('idx-order_item-order_id', '{{%order_item}}', 'order_id');
        $this->createIndex('idx-order_item-height', '{{%order_item}}', 'height');
        $this->createIndex('idx-order_item-width', '{{%order_item}}', 'width');
        $this->createIndex('idx-order_item-depth', '{{%order_item}}', 'depth');
        $this->createIndex('idx-order_item-wall_id', '{{%order_item}}', 'wall_id');
        $this->createIndex('idx-order_item-color_id', '{{%order_item}}', 'color_id');

        
        $this->addForeignKey('fk-order_item-order', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
        $this->dropTable('{{%order}}');
    }
}
