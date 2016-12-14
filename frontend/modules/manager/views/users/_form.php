<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <table style="width:100%" border="0">
        <tr>
            <td style="width: 40%; vertical-align: top; " align="left">
                     <img class="img-thumbnail" data-src="holder.js/140x140" alt="<?= $this->title ?>" style="width: 445px; height: 445px;" src="<?= $model->getPhoto() ?>" data-holder-rendered="true">

                <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>


            </td>

            <td style="width:60%">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Основная информация</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'birthday')->widget(\yii\jui\DatePicker::classname(), [
                            'language' => 'ru',
                            'dateFormat' => 'dd/MM/yyyy',
                            'clientOptions' => [
                                'changeMonth' => true,
                                'changeYear' => true,
                            ]
                        ]) ?>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Авторизация</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        <?=  $form->field($model, 'password')->passwordInput(['maxlength' => true, 'autocomplete'=>'off']) ?>
                        <?= $form->field($model, 'passwordConfirm')->passwordInput(['maxlength' => true]) ?>


                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Паспортные данные</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'passportSeria')->textInput() ?>

                        <?= $form->field($model, 'passportNumber')->textInput() ?>

                        <?= $form->field($model, 'passportInfo')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'passportDate')->widget(\yii\jui\DatePicker::classname(), [
                            'language' => 'ru',
                            'dateFormat' => 'dd/MM/yyyy',
                            'clientOptions' => [
                                'changeMonth' => true,
                                'changeYear' => true,
                            ]
                        ]) ?>

                        <?= $form->field($model, 'inn')->textInput() ?>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Контактная информация</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'phone3')->textInput(['maxlength' => true]) ?>


                    </div>
                </div>


                <div class="form-group pull-right">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>


            </td>


        </tr>
    </table>
    <?php ActiveForm::end(); ?>

</div>