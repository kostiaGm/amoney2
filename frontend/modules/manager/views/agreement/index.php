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


            'uid',
            'name',
            'text:ntext',
            'sum',
            // 'procentOfOneDay',
            // 'profit',
            // 'periodDays',
            // 'makerUserId',
            // 'ownerUserId',
            // 'amortizationDate',
            // 'createdAt',
            // 'updatedAt',
            // 'deletedAt',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
