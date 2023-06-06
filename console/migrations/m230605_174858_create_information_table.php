<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%information}}`.
 */
class m230605_174858_create_information_table extends Migration
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
        $this->createTable('{{%information}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'image' => $this->string(),
            'video' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-information-id', '{{%information}}', 'id');
        $this->createIndex('idx-information-name', '{{%information}}', 'name');
        $this->createIndex('idx-information-image', '{{%information}}', 'image');
        $this->createIndex('idx-information-video', '{{%information}}', 'video');
        $this->createIndex('idx-information-sort', '{{%information}}', 'sort');
        $this->createIndex('idx-information-status', '{{%information}}', 'status');
        $this->createIndex('idx-information-created_at', '{{%information}}', 'created_at');
        $this->createIndex('idx-information-updated_at', '{{%information}}', 'updated_at');
        $this->createIndex('idx-information-created_by', '{{%information}}', 'created_by');
        $this->createIndex('idx-information-updated_by', '{{%information}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%information}}');
    }
}
