<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Agreement */
/* @var $form yii\widgets\ActiveForm */

$user = null;
$userPhoto = Yii::$app->params['userNoPhoto'];
if ($model->uid) {
    $user = \backend\models\User::findOne($model->uid);
    $userPhoto = $user->getPhoto();
}

$collateral = \yii\helpers\ArrayHelper::map(\common\models\CollateralTypes::find()->all(), 'id', 'name');

?>

<div class="agreement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->hiddenInput(['maxlength' => true])->label(false) ?>
    <table width="100%" border="0" id="user-table" class="<?= (!$user ? 'hide' : '') ?>">
        <tr>
            <td width="30%" valign="top">
                <img id="user-photo" width="140" height="140" src="<?= $userPhoto ?>" >
            </td>
            <td width="70%" valign="top">
                <p id="user-name">
                    <strong>
                        <?= ($user ? $user->lastname .' '.$user->username .' '.$user->patronymic : '') ?>
                    </strong>
                </p>
                <p id="user-email">
                    <?= ($user ? $user->email  : '') ?>
                </p>
                <p id="user-phone1">
                    <?= ($user ? $user->phone1  : '') ?>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
    </table>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?php if ($collateral): ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'collateralTypesId')->dropDownList($collateral, ['prompt'=>'']) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'newCollateralType')->textInput() ?></div>

        </div>
    <?php else: ?>
        <?= $form->field($model, 'newCollateralType')->textInput() ?>
    <?php endif;?>




    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>


    <?php if (isset($model->id)): ?>
        <?php
        $returnDate = ((int) strtotime($model->createdAt ) + ( (int) $model->periodDays * 86400 ))
        ?>
        <table width="100%">
            <tr>
                <td width="50%"><strong>Дата займа:</strong></td>
                <td width="50%"><?= Yii::$app->formatter->asDatetime($model->createdAt) ?></td>
            </tr>
            <tr>
                <td width="50%"><strong>Срок залога:</strong></td>
                <td width="50%"><?= $model->periodDays ?> дн.</td>
            </tr>
            <tr>
                <td width="50%"><strong>Дата возврата:</strong></td>
                <td width="50%"><?= Yii::$app->formatter->asDatetime(  date('Y-m-d H:i:s', $returnDate) ) ?></td>
            </tr>
            <tr>
                <td width="50%"><strong>Процент пользования (день):</strong></td>
                <td width="50%"><?= $model->procentOfOneDay  ?> %</td>
            </tr>
        </table>
     <?php else: ?>

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'sum')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'periodDays')->textInput() ?></div>
            <div class="col-md-2"><?= $form->field($model, 'procentOfOneDay')->textInput() ?></div>

            <div class="col-md-2"><?= $form->field($model, 'profit')->textInput() ?></div>
            <div class="col-md-2"><?= $form->field($model, 'amortizationDate')->textInput() ?></div>
        </div>

    <?php endif; ?>

    <hr>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
