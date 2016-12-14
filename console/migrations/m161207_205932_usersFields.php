<?php

use yii\db\Migration;

class m161207_205932_usersFields extends Migration
{
    public function up()
    {
        $this->addColumn("user", "lastname", $this->string(255));
        $this->addColumn("user", "patronymic", $this->string(255));
        $this->addColumn("user", "photo", $this->string(255));
        $this->addColumn("user", "birthday", $this->dateTime());
        $this->addColumn("user", "passportSeria", $this->smallInteger()->unsigned());
        $this->addColumn("user", "passportNumber", $this->integer()->unsigned());
        $this->addColumn("user", "passportInfo", $this->text());
        $this->addColumn("user", "passportDate", $this->dateTime());
        $this->addColumn("user", "inn", $this->integer()->unsigned());
        $this->addColumn("user", "address", $this->text());
        $this->addColumn("user", "phone1", $this->string(255));
        $this->addColumn("user", "phone2", $this->string(255));
        $this->addColumn("user", "phone3", $this->string(255));

        $this->addColumn("user", "role", "enum('Administrator', 'Manager', 'User') DEFAULT 'User'");
    }

    public function down()
    {
        echo "m161207_205932_usersFields cannot be reverted.\n";

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
