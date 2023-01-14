<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meta_tag}}`.
 */
class m221106_141628_create_meta_tag_table extends Migration
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
        $this->createTable('{{%meta_tag}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->unique(),
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->text(),
            'og_title' => $this->string(),
            'og_description' => $this->text(),
            'og_image' => $this->string(),
            'og_url' => $this->string(),
            'og_sitename' => $this->string(),
            'og_type' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-meta_tag-id', '{{%meta_tag}}', 'id');
        $this->createIndex('idx-meta_tag-url', '{{%meta_tag}}', 'url');
        $this->createIndex('idx-meta_tag-meta_title', '{{%meta_tag}}', 'meta_title');
        $this->createIndex('idx-meta_tag-meta_keywords', '{{%meta_tag}}', 'meta_keywords');
        $this->createIndex('idx-meta_tag-og_title', '{{%meta_tag}}', 'og_title');
        $this->createIndex('idx-meta_tag-og_image', '{{%meta_tag}}', 'og_image');
        $this->createIndex('idx-meta_tag-og_url', '{{%meta_tag}}', 'og_url');
        $this->createIndex('idx-meta_tag-og_sitename', '{{%meta_tag}}', 'og_sitename');
        $this->createIndex('idx-meta_tag-og_type', '{{%meta_tag}}', 'og_type');
        $this->createIndex('idx-meta_tag-sort', '{{%meta_tag}}', 'sort');
        $this->createIndex('idx-meta_tag-status', '{{%meta_tag}}', 'status');
        $this->createIndex('idx-meta_tag-created_at', '{{%meta_tag}}', 'created_at');
        $this->createIndex('idx-meta_tag-updated_at', '{{%meta_tag}}', 'updated_at');
        $this->createIndex('idx-meta_tag-created_by', '{{%meta_tag}}', 'created_by');
        $this->createIndex('idx-meta_tag-updated_by', '{{%meta_tag}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta_tag}}');
    }
}
