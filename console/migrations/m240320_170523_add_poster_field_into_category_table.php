<?php

use yii\db\Migration;

/**
 * Class m240320_170523_add_poster_field_into_category_table
 */
class m240320_170523_add_poster_field_into_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%category}}', 'video_poster', $this->string());
        $this->createIndex('idx-category-video_poster', '{{%category}}', 'video_poster');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%category}}', 'video_poster');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240320_170523_add_poster_field_into_category_table cannot be reverted.\n";

        return false;
    }
    */
}
