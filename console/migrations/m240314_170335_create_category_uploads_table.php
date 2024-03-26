<?php

use yii\db\Migration;


class m240314_170335_create_category_uploads_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%category_upload}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'file_path' => $this->string(),
            'file_type' => $this->string(),
            'sort' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-category_upload-id', '{{%category_upload}}', 'id');
        $this->createIndex('idx-category_upload-category_id', '{{%category_upload}}', 'category_id');
        $this->createIndex('idx-category_upload-file_path', '{{%category_upload}}', 'file_path');
        $this->createIndex('idx-category_upload-file_type', '{{%category_upload}}', 'file_type');
        $this->createIndex('idx-category_upload-sort', '{{%category_upload}}', 'sort');
    }

    public function safeDown()
    {
        $this->dropTable('{{%category_upload}}');
    }
}
