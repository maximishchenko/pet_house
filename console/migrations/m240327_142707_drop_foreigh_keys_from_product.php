<?php

use yii\db\Migration;

/**
 * Class m240327_142707_drop_foreigh_keys_from_product
 */
class m240327_142707_drop_foreigh_keys_from_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk-product-category', '{{%product}}');
        $this->dropForeignKey('fk-product-material', '{{%product}}');
        $this->dropForeignKey('fk-product-color', '{{%product}}');
        $this->dropForeignKey('fk-product-engraving', '{{%product}}');
        $this->dropForeignKey('fk-product-wall', '{{%product}}');
        $this->dropForeignKey('fk-product-type', '{{%product}}');
        $this->dropForeignKey('fk-product-size', '{{%product}}');

        
        $this->addForeignKey('fk-product-category', '{{%product}}', 'category_id', '{{%category}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-material', '{{%product}}', 'material_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-color', '{{%product}}', 'color_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-engraving', '{{%product}}', 'engraving_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-wall', '{{%product}}', 'wall_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-type', '{{%product}}', 'type_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
        $this->addForeignKey('fk-product-size', '{{%product}}', 'type_id', '{{%property}}', 'id', 'SET NULL', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addForeignKey('fk-product-category', '{{%product}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-material', '{{%product}}', 'material_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-color', '{{%product}}', 'color_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-engraving', '{{%product}}', 'engraving_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-wall', '{{%product}}', 'wall_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-type', '{{%product}}', 'type_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product-size', '{{%product}}', 'type_id', '{{%property}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240327_142707_drop_foreigh_keys_from_product cannot be reverted.\n";

        return false;
    }
    */
}
