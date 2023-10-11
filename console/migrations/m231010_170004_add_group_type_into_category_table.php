<?php

use yii\db\Migration;

class m231010_170004_add_group_type_into_category_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'group_type', $this->string());
        $this->createIndex('idx-category-group_type', '{{%category}}', 'group_type');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'group_type');
    }
}
