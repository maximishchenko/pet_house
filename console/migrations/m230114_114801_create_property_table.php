<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%property}}`.
 */
class m230114_114801_create_property_table extends Migration
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
        $this->createTable('{{%property}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal()->defaultValue(0),
            'image' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->string()->defaultValue(0),
            'property_type' => $this->string()->notNull(),
            'item_type' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-property-id', '{{%property}}', 'id');
        $this->createIndex('idx-property-name', '{{%property}}', 'name');
        $this->createIndex('idx-property-price', '{{%property}}', 'price');
        $this->createIndex('idx-property-image', '{{%property}}', 'image');
        $this->createIndex('idx-property-sort', '{{%property}}', 'sort');
        $this->createIndex('idx-property-status', '{{%property}}', 'status');
        $this->createIndex('idx-property-property_type', '{{%property}}', 'property_type');
        $this->createIndex('idx-property-created_at', '{{%property}}', 'created_at');
        $this->createIndex('idx-property-updated_at', '{{%property}}', 'updated_at');
        $this->createIndex('idx-property-created_by', '{{%property}}', 'created_by');
        $this->createIndex('idx-property-updated_by', '{{%property}}', 'updated_by');

        $this->createTable('{{%property_image}}', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
            'sort' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-property_image-id', '{{%property_image}}', 'id');
        $this->createIndex('idx-property_image-property_id', '{{%property_image}}', 'property_id');
        $this->createIndex('idx-property_image-image', '{{%property_image}}', 'image');
        $this->createIndex('idx-property_image-sort', '{{%property_image}}', 'sort');

        $this->addForeignKey('fk-property_image-property', '{{%property_image}}', 'property_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%property_image}}');
        $this->dropTable('{{%property}}');
    }
}
