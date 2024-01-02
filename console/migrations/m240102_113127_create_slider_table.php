<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%slider}}`.
 */
class m240102_113127_create_slider_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'url' => $this->string(),
            'video' => $this->string(),
            'image' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
        $this->createIndex('idx-slider-id', '{{%slider}}', 'id');
        $this->createIndex('idx-slider-name', '{{%slider}}', 'name');
        $this->createIndex('idx-slider-url', '{{%slider}}', 'url');
        $this->createIndex('idx-slider-video', '{{%slider}}', 'video');
        $this->createIndex('idx-slider-image', '{{%slider}}', 'image');
        $this->createIndex('idx-slider-sort', '{{%slider}}', 'sort');
        $this->createIndex('idx-slider-status', '{{%slider}}', 'status');
        $this->createIndex('idx-slider-created_at', '{{%slider}}', 'created_at');
        $this->createIndex('idx-slider-updated_at', '{{%slider}}', 'updated_at');
        $this->createIndex('idx-slider-created_by', '{{%slider}}', 'created_by');
        $this->createIndex('idx-slider-updated_by', '{{%slider}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
