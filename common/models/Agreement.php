<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "agreement".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $name
 * @property string $text
 * @property double $sum
 * @property double $procentOfOneDay
 * @property double $profit
 * @property integer $periodDays

 * @property string $amortizationDate
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $deletedAt
 * @property integer $status
 */
class Agreement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $newCollateralType;

    public static function tableName()
    {
        return 'agreement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'periodDays','collateralTypesId'], 'required'],
            [['uid', 'periodDays', 'collateralTypesId', 'status', 'actualTermOfTheLoan'], 'integer'],
            [['text', 'newCollateralType'], 'string'],
            [['sum', 'procentOfOneDay', 'profit', 'actualAmountOfInterest', 'debt', 'totalDebt', 'actualDebtRepayment', 'actualIncome', 'actualProfit'], 'number'],
            [['returnDate', 'actualDateOfReturn', 'amortizationDate', 'createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'name' => Yii::t('app', 'Name'),
            'text' => Yii::t('app', 'Text'),
            'sum' => Yii::t('app', 'Sum'),
            'procentOfOneDay' => Yii::t('app', 'Procent Of One Day'),
            'profit' => Yii::t('app', 'Profit'),
            'periodDays' => Yii::t('app', 'Period Days'),
            'collateralTypesId' => Yii::t('app', 'Collateral Types'),
            'newCollateralType' => Yii::t('app', 'New Collateral Type'),

            'amortizationDate' => Yii::t('app', 'Amortization Date'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'deletedAt' => Yii::t('app', 'Deleted At'),
            'status' => Yii::t('app', 'Status'),
            'returnDate' => Yii::t('app', 'Return Date'),
            'actualDateOfReturn' => Yii::t('app', 'Actual Date Of Return'),
            'actualTermOfTheLoan' => Yii::t('app', 'Actual Term Of The Loan'),
            'actualAmountOfInterest' => Yii::t('app', 'Actual Amount Of Interest'),
            'totalDebt' => Yii::t('app', 'Total Debt'),
            'actualDebtRepayment' => Yii::t('app', 'Actual Debt Repayment'),
            'actualIncome' => Yii::t('app', 'Actual Income'),
            'actualProfit' => Yii::t('app', 'Actual Profit'),
            'debt' => Yii::t('app', 'Debt'),
        ];
    }

    /**
     * @inheritdoc
     * @return AgreementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AgreementQuery(get_called_class());
    }
}
