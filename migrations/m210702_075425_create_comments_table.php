<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210702_075425_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
                '{{%comments}}',
                [
                        'id' => $this->primaryKey(),
                        'user_id' => $this->integer()->null(),
                        'author_name' => $this->string()->null(),
                        'post_id' => $this->integer()->null(),
                        'parent_id' => $this->integer()->null(),
                        'text' => $this->string(),
                        'create_at' => $this->timestamp()->null(),
                        'update_at' => $this->timestamp()->null(),
                ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
