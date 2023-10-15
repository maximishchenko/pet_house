<?php

use yii\db\Migration;

class m231011_170945_add_size_prices_into_property_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'height_price', $this->decimal(65.2));
        $this->addColumn('{{%product}}', 'width_price', $this->decimal(65.2));
        $this->addColumn('{{%product}}', 'depth_price', $this->decimal(65.2));
        $this->createIndex('idx-product-height_price', '{{%product}}', 'height_price');
        $this->createIndex('idx-product-width_price', '{{%product}}', 'width_price');
        $this->createIndex('idx-product-depth_price', '{{%product}}', 'depth_price');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'height_price');
        $this->dropColumn('{{%product}}', 'width_price');
        $this->dropColumn('{{%product}}', 'depth_price');
    }
}
