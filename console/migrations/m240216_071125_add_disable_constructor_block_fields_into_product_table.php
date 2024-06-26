<?php

use yii\db\Migration;

/**
 * Class m240216_071125_add_disable_constructor_block_fields_into_product_table
 */
class m240216_071125_add_disable_constructor_block_fields_into_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'disable_color_block', $this->smallInteger());
        $this->addColumn('{{%product}}', 'disable_size_block', $this->smallInteger());
        $this->addColumn('{{%product}}', 'disable_wall_block', $this->smallInteger());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'disable_color_block');
        $this->dropColumn('{{%product}}', 'disable_size_block');
        $this->dropColumn('{{%product}}', 'disable_wall_block');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240216_071125_add_disable_constructor_block_fields_into_product_table cannot be reverted.\n";

        return false;
    }
    */
}
