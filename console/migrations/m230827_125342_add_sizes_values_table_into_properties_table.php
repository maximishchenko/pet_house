<?php

use yii\db\Migration;

/**
 * Class m230827_125342_add_sizes_values_table_into_properties_table
 */
class m230827_125342_add_sizes_values_table_into_properties_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%property}}', 'height_value', $this->string());
        $this->addColumn('{{%property}}', 'width_value', $this->string());
        $this->addColumn('{{%property}}', 'depth_value', $this->string());
        $this->createIndex('idx-property-height_value', '{{%property}}', 'height_value');
        $this->createIndex('idx-property-width_value', '{{%property}}', 'width_value');
        $this->createIndex('idx-property-depth_value', '{{%property}}', 'depth_value');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%property}}', 'height_value');
        $this->dropColumn('{{%property}}', 'width_value');
        $this->dropColumn('{{%property}}', 'depth_value');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230827_125342_add_sizes_values_table_into_properties_table cannot be reverted.\n";

        return false;
    }
    */
}
