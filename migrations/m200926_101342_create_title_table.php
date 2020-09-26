<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%title}}`.
     */
    class m200926_101342_create_title_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%title}}', [
                    'id' => $this->primaryKey(),
                    'store_id' => $this->integer()->defaultValue(null),
                    'upc'=>$this->string()->null()->defaultValue(null),
                    'title'=>$this->string(),
                    'price'=>$this->double()->null()->defaultValue(null),

            ]);

            $this->createIndex(
                    'store_id',
                    'title',
                    'store_id'
            );

            $this->addForeignKey(
                    'store_id',
                    'title',
                    'store_id',
                    'store',
                    'id',
                    'CASCADE'
            );
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%title}}');
        }
    }
