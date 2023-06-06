<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230114_133115_create_product_table extends Migration
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
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'image' => $this->string(),
            'category_id' => $this->integer(),
            'type_id' => $this->integer(),
            'material_id' => $this->integer(),
            'color_id' => $this->integer(),
            'wall_id' => $this->integer(),
            'engraving_id' => $this->integer(),
            'size_id' => $this->integer(),
            'is_available' => $this->boolean(),
            'price' => $this->decimal(65.2),
            'discount' => $this->integer(),
            'is_constructor_blocked' => $this->boolean(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'view_count' => $this->integer()->notNull()->defaultValue(1),
            'product_type' => $this->string(),
            'item_type' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-product-id', '{{%product}}', 'id');
        $this->createIndex('idx-product-name', '{{%product}}', 'name');
        $this->createIndex('idx-product-image', '{{%product}}', 'image');
        $this->createIndex('idx-product-slug', '{{%product}}', 'slug');
        $this->createIndex('idx-product-category_id', '{{%product}}', 'category_id');
        $this->createIndex('idx-product-type_id', '{{%product}}', 'type_id');
        $this->createIndex('idx-product-material_id', '{{%product}}', 'material_id');
        $this->createIndex('idx-product-color_id', '{{%product}}', 'color_id');
        $this->createIndex('idx-product-wall_id', '{{%product}}', 'wall_id');
        $this->createIndex('idx-product-engraving_id', '{{%product}}', 'engraving_id');
        $this->createIndex('idx-product-size_id', '{{%product}}', 'size_id');
        $this->createIndex('idx-product-is_available', '{{%product}}', 'is_available');
        $this->createIndex('idx-product-price', '{{%product}}', 'price');
        $this->createIndex('idx-product-discount', '{{%product}}', 'discount');
        $this->createIndex('idx-product-is_constructor_blocked', '{{%product}}', 'is_constructor_blocked');
        $this->createIndex('idx-product-view_count', '{{%product}}', 'view_count');
        $this->createIndex('idx-product-product_type', '{{%product}}', 'product_type');
        $this->createIndex('idx-product-item_type', '{{%product}}', 'item_type');
        $this->createIndex('idx-product-sort', '{{%product}}', 'sort');
        $this->createIndex('idx-product-status', '{{%product}}', 'status');
        $this->createIndex('idx-product-created_at', '{{%product}}', 'created_at');
        $this->createIndex('idx-product-updated_at', '{{%product}}', 'updated_at');
        $this->createIndex('idx-product-created_by', '{{%product}}', 'created_by');
        $this->createIndex('idx-product-updated_by', '{{%product}}', 'updated_by');

        $this->addForeignKey('fk-product-category', '{{%product}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-material', '{{%product}}', 'material_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-color', '{{%product}}', 'color_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-engraving', '{{%product}}', 'engraving_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-wall', '{{%product}}', 'wall_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-type', '{{%product}}', 'type_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-size', '{{%product}}', 'type_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'sort' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-product_image-id', '{{%product_image}}', 'id');
        $this->createIndex('idx-product_image-product_id', '{{%product_image}}', 'product_id');
        $this->createIndex('idx-product_image-image', '{{%product_image}}', 'image');
        $this->createIndex('idx-product_image-sort', '{{%product_image}}', 'sort');

        $this->addForeignKey('fk-product_image-product', '{{%product_image}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        
        $this->createTable('{{%product_attribute}}', [
            'product_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-product_attribute', '{{%product_attribute}}', ['product_id', 'attribute_id']);
        
        $this->createIndex('idx-product_attribute-product_id', '{{%product_attribute}}', 'product_id');
        $this->createIndex('idx-product_attribute-attribute_id', '{{%product_attribute}}', 'attribute_id');

        $this->addForeignKey('fk-product_attribute-product', '{{%product_attribute}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_attribute-attribute', '{{%product_attribute}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%product_material}}', [
            'product_id' => $this->integer()->notNull(),
            'material_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-product_material', '{{%product_material}}', ['product_id', 'material_id']);
        
        $this->createIndex('idx-product_material-product_id', '{{%product_material}}', 'product_id');
        $this->createIndex('idx-product_material-material_id', '{{%product_material}}', 'material_id');

        $this->addForeignKey('fk-product_material-product', '{{%product_material}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_material-attribute', '{{%product_material}}', 'material_id', '{{%attribute}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_material}}');
        $this->dropTable('{{%product_attribute}}');
        $this->dropTable('{{%product_image}}');
        $this->dropTable('{{%product}}');
    }
}
