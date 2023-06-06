<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%property_link}}`.
 */
class m230604_112008_create_property_link_table extends Migration
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
        $this->createTable('{{%property_link}}', [
            'source_id' => $this->integer()->notNull(),
            'target_id' => $this->integer()->notNull(),
            'item_type' => $this->string()->notNull(),
            'property_type' => $this->string()->notNull(),
        ], $tableOptions);        

        $this->addPrimaryKey('pk-property_link', '{{%property_link}}', ['source_id', 'target_id']);

        $this->createIndex('idx-property_link-source_id', '{{%property_link}}', 'source_id');
        $this->createIndex('idx-property_link-target_id', '{{%property_link}}', 'target_id');
        $this->createIndex('idx-property_link-item_type', '{{%property_link}}', 'item_type');
        $this->createIndex('idx-property_link-property_type', '{{%property_link}}', 'property_type');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%property_link}}');
    }
}
