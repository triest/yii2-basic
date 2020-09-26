<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%import}}`.
     */
    class m200926_130604_create_import_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%import}}', [
                    'id' => $this->primaryKey(),
                    'store_id' => $this->integer()->defaultValue(null),
                    'job_id' => $this->integer()->defaultValue(null),
                    'status' => $this->string(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%import}}');
        }
    }
