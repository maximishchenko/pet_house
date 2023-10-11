<?php

use yii\db\Migration;

class m231010_173952_add_group_id_into_product_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'group_id', $this->string());
        $this->createIndex('idx-product-group_id', '{{%product}}', 'group_id');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'group_id');
    }
}
