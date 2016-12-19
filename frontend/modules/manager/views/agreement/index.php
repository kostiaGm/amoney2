<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AgreementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Agreements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreement-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Agreement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute'=>'uid',
                'format' => 'raw',
                'value' => function($data) {
                    return  $data->user->lastname
                    .' '.$data->user->username
                    .' '.$data->user->patronymic
                    .' <br>'.(!empty($data->user->email) ? $data->user->email : '')
                    . (!empty($data->user->phone1) ? '<br>(т. '.$data->user->phone1.')' : '');
                }
            ],
            [
                'attribute'=>'collateralTypesId',
                'format' => 'raw',
                'value' => function($data) {
                    return  $data->collateral->name;
                }
            ],

            'createdAt',

            [
                'attribute'=>'periodDays',
                'format' => 'raw',
                'value' => function($data) {
                    return  $data->periodDays .' дн. ('.$data->returnDate .')';
                }
            ],

            'actualDateOfReturn',
            'actualTermOfTheLoan',
            'procentOfOneDay',
            'actualAmountOfInterest',
            'totalDebt',
            'actualDebtRepayment',
            'debt',
            'actualIncome',

            'actualProfit',



            //'text:ntext',
            'sum',
            // 'procentOfOneDay',
            // 'profit',
            // 'periodDays',
            // 'makerUserId',
            // 'ownerUserId',
            // 'amortizationDate',

            // 'updatedAt',
            // 'deletedAt',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
