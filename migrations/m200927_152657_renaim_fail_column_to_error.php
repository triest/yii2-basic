<?php

    use yii\db\Migration;

    /**
     * Class m200927_152657_renaim_fail_column_to_error
     */
    class m200927_152657_renaim_fail_column_to_error extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->renameColumn('import', 'fail_count', 'error_count');
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->renameColumn('import', 'error_count', 'fail_count');
        }

        /*
        // Use up()/down() to run migration code without a transaction.
        public function up()
        {

        }

        public function down()
        {
            echo "m200927_152657_renaim_fail_column_to_error cannot be reverted.\n";

            return false;
        }
        */
    }
