<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Agreement */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$userPhoto = $userPhoto = $user->getPhoto();
?>
<div class="agreement-view">



    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [

            'uid',

            'text:ntext',
            'sum',
            'procentOfOneDay',
            'profit',
            'periodDays',

            'amortizationDate',
            'createdAt',
            'returnDate',
            'actualDateOfReturn',
            'actualTermOfTheLoan',
            'actualAmountOfInterest',
            'totalDebt',
            'debt',
            'actualDebtRepayment',
            'actualIncome',
            'actualProfit',
            'status',
        ],
    ]) */?>

    <table width="100%" border="0" id="user-table" class="<?= (!$user ? 'hide' : '') ?>">
        <tr>
            <td width="30%" valign="top">
                <img id="user-photo" width="140" height="140" src="<?= $userPhoto ?>" >
            </td>
            <td width="70%" valign="top">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><?= ($user ? $user->lastname .' '.$user->username .' '.$user->patronymic : '') .
                        (!empty($user->phone1) ? ' т. '.$user->phone1 : '') ?>
                        </strong>
                    </div>
                    <div class="panel-body">
                        <p>
                            <strong><?= Yii::$app->formatter->asDatetime($model->createdAt) ?></strong>
                            получил займ в размере <strong><?= $model->sum ?> грн. </strong>
                            под  <strong><?= $model->procentOfOneDay ?> % в день </strong>
                            сроком на  <strong><?= $model->periodDays ?> дней </strong>
                            <i>(до <?= Yii::$app->formatter->asDatetime($model->returnDate) ?> включительно)</i>.

                        </p>
                        <p>
                            Залог: <strong><?= $collateralType ?></strong>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Информация по факту</strong>
                    </div>
                    <div class="panel-body">
                        <table width="50%" class="pull-left">
                            <tr>
                                <td width="50%"><strong>Сумма кредита:</strong></td>
                                <td width="50%"><?= Yii::$app->formatter->asDecimal($model->sum) ?> грн.</td>
                            </tr>
                            <tr>
                                <td width="50%"><strong>Сумма процента: </strong></td>
                                <td width="50%"><?= Yii::$app->formatter->asDecimal($model->actualAmountOfInterest) ?> грн. </td>
                            </tr>

                            <tr>
                                <td width="50%"><strong>Фактическое погашение: </strong></td>
                                <td width="50%"><?= Yii::$app->formatter->asDecimal($model->actualDebtRepayment) ?> грн. </td>
                            </tr>


                            <tr>
                                <td width="50%"><strong>Задолжность: </strong></td>
                                <td width="50%"><?= Yii::$app->formatter->asDecimal($model->debt) ?> грн. </td>
                            </tr>



                            <tr>
                                <td width="50%"><strong>Общая задолжность: </strong></td>
                                <td width="50%"><?= Yii::$app->formatter->asDecimal($model->totalDebt) ?> грн. </td>
                            </tr>

                        </table>

                        <table width="40%" class="pull-right">
                            <tr>
                                <td><strong>Фактический доход</strong></td>
                                <td><?=  Yii::$app->formatter->asDecimal($model->actualIncome) ?> грн.</td>
                            </tr>
                            <tr>
                                <td><strong>Фактическая прибыль</strong></td>
                                <td><?=  Yii::$app->formatter->asDecimal($model->actualProfit) ?> грн.</td>
                            </tr>
                            <tr>

                                <td colspan="2"><h3><?= Yii::t('app', Yii::$app->params['agreementStatus'][$model->status]) ?></h3></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
            </td>
        </tr>
    </table>

</div>


<?php
Modal::begin([
    'id' => 'user-modal',
    'toggleButton' => [
        'label' => '<i class="glyphicon glyphicon-plus"></i> '.Yii::t('app', 'Create Transaction'),
        'class' => 'btn btn-success'
    ],

    'closeButton' => [
        'label' => 'Close',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],
    'size' => 'modal-lg',
]);

?>

<div class="transactions-form">

    <?php $form = ActiveForm::begin(['action'=>'/manager/transactions/create?agreement-view='.$model->id]); ?>

    <?= $form->field($transactionModel, 'agreementId')->hiddenInput()->label(false) ?>

    <?= $form->field($transactionModel, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($transactionModel, 'text')->textarea() ?>

    <?= $form->field($transactionModel, 'sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
Modal::end();
?>
<hr>
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],



        'type',
        'text',
        'createdAt',
        'sum',

       // ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php Pjax::end(); ?>

</div>


