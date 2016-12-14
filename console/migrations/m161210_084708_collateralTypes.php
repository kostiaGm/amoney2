<?php

use yii\db\Migration;

class m161210_084708_collateralTypes extends Migration
{
    public function up()
    {
        $this->createTable('collateralTypes', [
            "id" => $this->primaryKey(),
            "name" => $this->string(255)
        ]);
    }

    public function down()
    {
        echo "m161210_084708_collateralTypes cannot be reverted.\n";

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
