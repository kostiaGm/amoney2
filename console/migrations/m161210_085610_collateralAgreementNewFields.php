<?php

use yii\db\Migration;

class m161210_085610_collateralAgreementNewFields extends Migration
{
    public function up()
    {
        $this->addColumn('agreement', 'collateralTypesId', $this->integer()->unsigned());
        $this->dropColumn('agreement', 'makerUserId');
        $this->dropColumn('agreement', 'ownerUserId');
    }

    public function down()
    {
        echo "m161210_085610_collateralAgreementNewFields cannot be reverted.\n";

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
