<?php

    use yii\db\Migration;

    /**
     * Class m200926_150614_add_filename_to_import
     */
    class m200926_150614_add_filename_to_import extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->addColumn('import', 'filename', $this->string());
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropColumn('import', 'filename');

            return false;
        }

        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {

        }

        public function down()
        {
            echo "m200926_150614_add_filename_to_import cannot be reverted.\n";

            return false;
        }
        */
    }
