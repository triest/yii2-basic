<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post_tag}}`.
 */
class m210705_200104_create_post_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post_tag}}', [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->null(),
                'tag_id' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post_tag}}');
    }
}
