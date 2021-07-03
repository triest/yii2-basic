<?php

use yii\db\Migration;

/**
 * Class m210702_172113_add_main_image_to_users
 */
class m210702_172113_add_main_image_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'main_image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'main_image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210702_172113_add_main_image_to_users cannot be reverted.\n";

        return false;
    }
    */
}
