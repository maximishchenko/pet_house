<?php

use yii\db\Migration;

/**
 * Class m230629_182716_add_product_accessories_table
 */
class m230629_182716_add_product_accessories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%product_accessory}}', [
            'product_id' => $this->integer()->notNull(),
            'accessory_id' => $this->integer()->notNull(),
            'product_type' => $this->string()->notNull(),
            'count' => $this->string()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->addPrimaryKey('pk-product_accessory', '{{%product_accessory}}', ['product_id', 'accessory_id']);

        $this->createIndex('idx-product_accessory-product_id', '{{%product_accessory}}', 'product_id');
        $this->createIndex('idx-product_accessory-accessory_id', '{{%product_accessory}}', 'accessory_id');
        $this->createIndex('idx-product_accessory-product_type', '{{%product_accessory}}', 'product_type');
        $this->createIndex('idx-product_accessory-count', '{{%product_accessory}}', 'count');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_accessory}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230629_182716_add_product_accessories_table cannot be reverted.\n";

        return false;
    }
    */
}
