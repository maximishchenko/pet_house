<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%script}}`.
 */
class m221106_141618_create_script_table extends Migration
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
        $this->createTable('{{%script}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'position' => $this->string(50),
            'code' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        
        $this->createIndex('idx-script-id', '{{%script}}', 'id');
        $this->createIndex('idx-script-name', '{{%script}}', 'name');
        $this->createIndex('idx-script-position', '{{%script}}', 'position');
        $this->createIndex('idx-script-sort', '{{%script}}', 'sort');
        $this->createIndex('idx-script-status', '{{%script}}', 'status');
        $this->createIndex('idx-script-created_at', '{{%script}}', 'created_at');
        $this->createIndex('idx-script-updated_at', '{{%script}}', 'updated_at');
        $this->createIndex('idx-script-created_by', '{{%script}}', 'created_by');
        $this->createIndex('idx-script-updated_by', '{{%script}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%script}}');
    }
}
