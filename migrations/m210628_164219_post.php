<?php

use yii\db\Migration;

/**
 * Class m210628_164219_post
 */
class m210628_164219_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%posts}}', [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'description' => $this->string(2024)->notNull(),
                'author_id' => $this->integer(),
                'update_at' => $this->timestamp()->notNull(),
                'create_at' => $this->timestamp()->defaultValue()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%posts}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210628_164219_post cannot be reverted.\n";

        return false;
    }
    */
}
