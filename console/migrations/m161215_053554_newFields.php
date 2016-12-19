<?php

use yii\db\Migration;

class m161215_053554_newFields extends Migration
{
    public function up()
    {
        $this->addColumn("user", "dept", "double(11,2) default 0");

    }

    public function down()
    {
        echo "m161215_053554_newFields cannot be reverted.\n";

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
