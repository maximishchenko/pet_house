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
            'text_color' => $this->string(),
            'button_text_color' => $this->string(),
            'button_bg_color' => $this->string(),
            'url' => $this->string(),
            'video' => $this->string(),
            'image' => $this->string(),
            'video_mobile' => $this->string(),
            'image_mobile' => $this->string(),
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
        $this->createIndex('idx-slider-video_mobile', '{{%slider}}', 'video_mobile');
        $this->createIndex('idx-slider-image_mobile', '{{%slider}}', 'image_mobile');
        $this->createIndex('idx-slider-text_color', '{{%slider}}', 'text_color');
        $this->createIndex('idx-slider-button_text_color', '{{%slider}}', 'button_text_color');
        $this->createIndex('idx-slider-button_bg_color', '{{%slider}}', 'button_bg_color');
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
