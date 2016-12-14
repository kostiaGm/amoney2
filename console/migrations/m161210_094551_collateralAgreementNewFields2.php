<?php

use yii\db\Migration;

class m161210_094551_collateralAgreementNewFields2 extends Migration
{
    public function up()
    {
        $this->addColumn('agreement', 'returnDate', $this->dateTime()); // дата возврата
        $this->addColumn('agreement', 'actualDateOfReturn', $this->dateTime()); // фактическая дата возврата
        $this->addColumn('agreement', 'actualTermOfTheLoan', $this->integer()->unsigned()); // Фактический срок кредита
        $this->addColumn('agreement', 'actualAmountOfInterest',  "double(11,2)"); // Фактическая сумма процентов
        $this->addColumn('agreement', 'totalDebt', "double(11,2)"); // Общая задолженность
        $this->addColumn('agreement', 'debt', "double(11,2)"); // Задолженность
        $this->addColumn('agreement', 'actualDebtRepayment', "double(11,2)"); // Фактическое погашение
        $this->addColumn('agreement', 'actualIncome', "double(11,2)"); // Фактический доход
        $this->addColumn('agreement', 'actualProfit', "double(11,2)"); // Фактическая прибыль
    }

    public function down()
    {
        echo "m161210_094551_collateralAgreementNewFields2 cannot be reverted.\n";

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
