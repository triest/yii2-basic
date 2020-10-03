<?php

    use yii\db\Migration;

    /**
     * Class m200927_150652_add_success_and_errors_count_to_import_table
     */
    class m200927_150652_add_success_and_errors_count_to_import_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->addColumn('import', 'success_count', $this->integer());
            $this->addColumn('import', 'fail_count', $this->integer());
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropColumn('import', 'success_count');
            $this->dropColumn('import', 'fail_count');
        }

        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {

        }

        public function down()
        {
            echo "m200927_150652_add_success_and_errors_count_to_import_table cannot be reverted.\n";

            return false;
        }
        */
    }
