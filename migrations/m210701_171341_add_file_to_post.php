<?php

use yii\db\Migration;

/**
 * Class m210701_171341_add_file_to_post
 */
class m210701_171341_add_file_to_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts', 'main_image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('posts','main_image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210701_171341_add_file_to_post cannot be reverted.\n";

        return false;
    }
    */
}
