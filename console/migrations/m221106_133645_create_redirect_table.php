<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%redirect}}`.
 */
class m221106_133645_create_redirect_table extends Migration
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
        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(),
            'source_url' => $this->string(),
            'destination_url' => $this->string(),
            'redirect_code' => $this->integer(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-redirect-id', '{{%redirect}}', 'id');
        $this->createIndex('idx-redirect-source_url', '{{%redirect}}', 'source_url');
        $this->createIndex('idx-redirect-destination_url', '{{%redirect}}', 'destination_url');
        $this->createIndex('idx-redirect-redirect_code', '{{%redirect}}', 'redirect_code');
        $this->createIndex('idx-redirect-sort', '{{%redirect}}', 'sort');
        $this->createIndex('idx-redirect-status', '{{%redirect}}', 'status');
        $this->createIndex('idx-redirect-created_at', '{{%redirect}}', 'created_at');
        $this->createIndex('idx-redirect-updated_at', '{{%redirect}}', 'updated_at');
        $this->createIndex('idx-redirect-created_by', '{{%redirect}}', 'created_by');
        $this->createIndex('idx-redirect-updated_by', '{{%redirect}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%redirect}}');
    }
}
