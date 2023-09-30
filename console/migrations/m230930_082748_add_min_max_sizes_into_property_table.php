<?php

use yii\db\Migration;

/**
 * Class m230930_082748_add_min_max_sizes_into_property_table
 */
class m230930_082748_add_min_max_sizes_into_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%property}}', 'min_height', $this->string());
        $this->addColumn('{{%property}}', 'min_width', $this->string());
        $this->addColumn('{{%property}}', 'min_depth', $this->string());
        $this->addColumn('{{%property}}', 'max_height', $this->string());
        $this->addColumn('{{%property}}', 'max_width', $this->string());
        $this->addColumn('{{%property}}', 'max_depth', $this->string());
        $this->addColumn('{{%property}}', 'step', $this->integer());
        $this->createIndex('idx-property-min_height', '{{%property}}', 'min_height');
        $this->createIndex('idx-property-min_width', '{{%property}}', 'min_width');
        $this->createIndex('idx-property-min_depth', '{{%property}}', 'min_depth');
        $this->createIndex('idx-property-max_height', '{{%property}}', 'max_height');
        $this->createIndex('idx-property-max_width', '{{%property}}', 'max_width');
        $this->createIndex('idx-property-max_depth', '{{%property}}', 'max_depth');
        $this->createIndex('idx-property-step', '{{%property}}', 'step');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%property}}', 'min_height');
        $this->dropColumn('{{%property}}', 'min_width');
        $this->dropColumn('{{%property}}', 'min_depth');
        $this->dropColumn('{{%property}}', 'max_height');
        $this->dropColumn('{{%property}}', 'max_width');
        $this->dropColumn('{{%property}}', 'max_depth');
        $this->dropColumn('{{%property}}', 'step');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230930_082748_add_min_max_sizes_into_property_table cannot be reverted.\n";

        return false;
    }
    */
}
