<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%settings}}`.
 */
class m221107_170038_create_settings_table extends Migration
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
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'key' => $this->string(),
            'value' => $this->string(),
            'field_type' => $this->string(),
            'tab' => $this->string(),
        ], $tableOptions);

        $this->createIndex('idx-setting-id', '{{%setting}}', 'id');
        $this->createIndex('idx-setting-name', '{{%setting}}', 'name');
        $this->createIndex('idx-setting-key', '{{%setting}}', 'key');
        $this->createIndex('idx-setting-value', '{{%setting}}', 'value');
        $this->createIndex('idx-setting-field_type', '{{%setting}}', 'field_type');
        $this->createIndex('idx-setting-tab', '{{%setting}}', 'tab');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
