<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review}}`.
 */
class m230917_191133_create_review_table extends Migration
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
        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
            'avatar' => $this->string(),
            'status' => $this->string(),
            'is_favorite' => $this->boolean()->defaultValue(0),
            'text' => $this->text(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
        ], $tableOptions);

        
        $this->createIndex('idx-review-id', '{{%review}}', 'id');
        $this->createIndex('idx-review-name', '{{%review}}', 'name');
        $this->createIndex('idx-review-image', '{{%review}}', 'image');
        $this->createIndex('idx-review-avatar', '{{%review}}', 'avatar');
        $this->createIndex('idx-review-status', '{{%review}}', 'status');
        $this->createIndex('idx-review-is_favorite', '{{%review}}', 'is_favorite');
        $this->createIndex('idx-review-sort', '{{%review}}', 'sort');
        $this->createIndex('idx-review-created_at', '{{%review}}', 'created_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review}}');
    }
}
