<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%import_status}}`.
 */
class m200927_172925_create_import_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%import_status}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->null()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%import_status}}');
    }
}
