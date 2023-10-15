<?php

use yii\db\Migration;

class m231011_170945_add_size_prices_into_property_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%property}}', 'height_price', $this->decimal(65.2));
        $this->addColumn('{{%property}}', 'width_price', $this->decimal(65.2));
        $this->addColumn('{{%property}}', 'depth_price', $this->decimal(65.2));
        $this->createIndex('idx-property-height_price', '{{%property}}', 'height_price');
        $this->createIndex('idx-property-width_price', '{{%property}}', 'width_price');
        $this->createIndex('idx-property-depth_price', '{{%property}}', 'depth_price');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%property}}', 'height_price');
        $this->dropColumn('{{%property}}', 'width_price');
        $this->dropColumn('{{%property}}', 'depth_price');
    }
}
