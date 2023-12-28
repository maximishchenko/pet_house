<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_image}}`.
 */
class m231227_111802_create_order_image_table extends Migration
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
        $this->createTable('{{%order_image}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'image' => $this->string(),
        ], $tableOptions);
        $this->createIndex('idx-order_image-id', '{{%order_image}}', 'id');
        $this->createIndex('idx-order_image-order_id', '{{%order_image}}', 'order_id');
        $this->createIndex('idx-order_image-image', '{{%order_image}}', 'image');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_image}}');
    }
}
