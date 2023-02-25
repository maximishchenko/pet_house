<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m230114_115828_create_category_table extends Migration
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
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'image' => $this->string(),
            'font_color' => $this->string(),
            'text_color' => $this->string(),
            'badge_color' => $this->string(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'property_type' => $this->string()->notNull(),
            'item_type' => $this->string()->notNull(),
            'sort' => $this->integer(),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-category-id', '{{%category}}', 'id');
        $this->createIndex('idx-category-name', '{{%category}}', 'name');
        $this->createIndex('idx-category-slug', '{{%category}}', 'slug');
        $this->createIndex('idx-category-image', '{{%category}}', 'image');
        $this->createIndex('idx-category-font_color', '{{%category}}', 'font_color');
        $this->createIndex('idx-category-text_color', '{{%category}}', 'text_color');
        $this->createIndex('idx-category-badge_color', '{{%category}}', 'badge_color');
        $this->createIndex('idx-category-property_type', '{{%category}}', 'property_type');
        $this->createIndex('idx-category-item_type', '{{%category}}', 'item_type');
        $this->createIndex('idx-category-sort', '{{%category}}', 'sort');
        $this->createIndex('idx-category-status', '{{%category}}', 'status');
        $this->createIndex('idx-category-created_at', '{{%category}}', 'created_at');
        $this->createIndex('idx-category-updated_at', '{{%category}}', 'updated_at');
        $this->createIndex('idx-category-created_by', '{{%category}}', 'created_by');
        $this->createIndex('idx-category-updated_by', '{{%category}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
