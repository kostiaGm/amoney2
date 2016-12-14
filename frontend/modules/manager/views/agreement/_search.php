<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AgreementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agreement-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'procentOfOneDay') ?>

    <?php // echo $form->field($model, 'profit') ?>

    <?php // echo $form->field($model, 'periodDays') ?>

    <?php // echo $form->field($model, 'makerUserId') ?>

    <?php // echo $form->field($model, 'ownerUserId') ?>

    <?php // echo $form->field($model, 'amortizationDate') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <?php // echo $form->field($model, 'deletedAt') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
