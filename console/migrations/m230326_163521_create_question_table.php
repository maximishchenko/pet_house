<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m230326_163521_create_question_table extends Migration
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
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'question' => $this->string()->notNull(),
            'answer' => $this->text()->notNull(),
            'position' => $this->string()->notNull(),
            'sort' => $this->integer(),
            'status' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-question-id', '{{%question}}', 'id');
        $this->createIndex('idx-question-question', '{{%question}}', 'question');
        $this->createIndex('idx-question-position', '{{%question}}', 'position');
        $this->createIndex('idx-question-sort', '{{%question}}', 'sort');
        $this->createIndex('idx-question-status', '{{%question}}', 'status');
        $this->createIndex('idx-question-created_at', '{{%question}}', 'created_at');
        $this->createIndex('idx-question-updated_at', '{{%question}}', 'updated_at');
        $this->createIndex('idx-question-created_by', '{{%question}}', 'created_by');
        $this->createIndex('idx-question-updated_by', '{{%question}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
