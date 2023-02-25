<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%material}}`.
 */
class m230114_132645_create_material_table extends Migration
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
        $this->createTable('{{%material}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'video' => $this->string(),
            'description' => $this->text(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->string()->defaultValue(0),
            'product_type' => $this->string(),
            'item_type' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-material-id', '{{%material}}', 'id');
        $this->createIndex('idx-material-name', '{{%material}}', 'name');
        $this->createIndex('idx-material-image', '{{%material}}', 'image');
        $this->createIndex('idx-material-video', '{{%material}}', 'video');
        $this->createIndex('idx-material-sort', '{{%material}}', 'sort');
        $this->createIndex('idx-material-status', '{{%material}}', 'status');
        $this->createIndex('idx-material-product_type', '{{%material}}', 'product_type');
        $this->createIndex('idx-material-item_type', '{{%material}}', 'item_type');
        $this->createIndex('idx-material-created_at', '{{%material}}', 'created_at');
        $this->createIndex('idx-material-updated_at', '{{%material}}', 'updated_at');
        $this->createIndex('idx-material-created_by', '{{%material}}', 'created_by');
        $this->createIndex('idx-material-updated_by', '{{%material}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%material}}');
    }
}
