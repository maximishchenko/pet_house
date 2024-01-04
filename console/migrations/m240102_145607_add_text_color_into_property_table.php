<?php

use yii\db\Migration;

/**
 * Class m240102_145607_add_text_color_into_property_table
 */
class m240102_145607_add_text_color_into_property_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%property}}', 'text_color', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%property}}', 'text_color');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240102_145607_add_text_color_into_property_table cannot be reverted.\n";

        return false;
    }
    */
}
