<?php

use yii\db\Migration;

/**
 * Class m240210_155019_add_hide_constructor_block_fields_into_product_table
 */
class m240210_155019_add_hide_constructor_block_fields_into_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'hide_color_block', $this->smallInteger());
        $this->addColumn('{{%product}}', 'hide_size_block', $this->smallInteger());
        $this->addColumn('{{%product}}', 'hide_wall_block', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'hide_color_block');
        $this->dropColumn('{{%product}}', 'hide_size_block');
        $this->dropColumn('{{%product}}', 'hide_wall_block');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240210_155019_add_hide_constructor_block_fields_into_product_table cannot be reverted.\n";

        return false;
    }
    */
}
