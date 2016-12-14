<?php

use yii\db\Migration;

class m161209_174344_document extends Migration
{
    public function up()
    {
        $this->createTable("agreement", [
            "id" => $this->primaryKey(),
            "uid" => $this->integer(),
            "name" => $this->string(255),

            "text" => $this->text(),
            "sum" => $this->double(11.2),
            "procentOfOneDay" => $this->double(11.2),
            "profit" => $this->double(11.2),
            "periodDays" => $this->integer(),
            "makerUserId" => $this->integer(),
            "ownerUserId" => $this->integer(),
            "amortizationDate" => $this->dateTime(),
            "createdAt" => $this->dateTime(),
            "updatedAt" => $this->dateTime(),
            "deletedAt" => $this->dateTime(),
            "status"=> $this->smallInteger()->defaultValue(1) // 0 - актирвный - 2
        ]);
    }

    public function down()
    {
        echo "m161209_174344_document cannot be reverted.\n";

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
