<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m210705_200047_create_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
                '{{%tags}}',
                [
                        'id' => $this->primaryKey(),
                        'title' => $this->string(),
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
        $this->dropTable('{{%tags}}');
    }
}
