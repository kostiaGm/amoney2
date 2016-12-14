<?php

use yii\db\Migration;

class m161210_131405_transactions extends Migration
{
    public function up()
    {
        $this->createTable('transactions', [
            'id' => $this->primaryKey(),
            "agreementId" => $this->integer(),
            "type" => $this->string(255),
            "text" => $this->text(),
            "createdAt" => $this->dateTime(),
            "sum" => "double(11,2)"

        ]);
    }

    public function down()
    {
        echo "m161210_131405_transactions cannot be reverted.\n";

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
