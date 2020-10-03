<?php

use yii\db\Migration;

/**
 * Class m201003_125518_add_error_to_import
 */
class m201003_125518_add_error_to_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('import', 'error', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('import', 'error');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201003_125518_add_error_to_import cannot be reverted.\n";

        return false;
    }
    */
}
