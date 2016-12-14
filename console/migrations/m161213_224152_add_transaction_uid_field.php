<?php

use yii\db\Migration;

class m161213_224152_add_transaction_uid_field extends Migration
{
    public function up()
    {
        $this->addColumn('transactions', 'uid', $this->integer()->unsigned()); // дата возврата

    }

    public function down()
    {
        echo "m161213_224152_add_transaction_uid_field cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
