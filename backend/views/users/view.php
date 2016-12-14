<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title =  $model->lastname. ' '. $model->username.' '.$model->patronymic;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1 class="pull-left1"><?= Html::encode($this->title) ?>

        <?php if (isset(Yii::$app->params['status'][$model->status])): ?>
            <?php if (Yii::$app->params['status'][$model->status] == 'New'): ?>
                <span class="label label-success"><?= Yii::$app->params['status'][$model->status] ?> (not active)</span>
            <?php endif; ?>

            <?php if (Yii::$app->params['status'][$model->status] == 'Active'): ?>
                <span class="label label-primary"><?= Yii::$app->params['status'][$model->status] ?></span>
            <?php endif; ?>


            <?php if (Yii::$app->params['status'][$model->status] == 'Deleted'): ?>
                <span class="label label-danger"><?= Yii::$app->params['status'][$model->status] ?></span>
            <?php endif; ?>
        <?php endif; ?>

    <p class="pull-right" style="font-size: 12px">
        <?= Yii::$app->formatter->asDate($model->created_at, 'd MMMM yyyy г.'); ?>

    </p>
    </h1>
    <div class="clearfix"></div>
    <hr>
<table style="width:100%" border="0">
    <tr>
        <td style="width: 40%; vertical-align: top; " align="left">

                <img class="img-thumbnail" data-src="holder.js/140x140" alt="<?= $this->title ?>" style="width: 445px; height: 445px;" src="<?= $model->getPhoto() ?>" data-holder-rendered="true">


        </td>

        <td style="width:60%">  <?= DetailView::widget([
                'model' => $model,
                'formatter' => [
                    'class'=>'yii\i18n\Formatter',
                    'dateFormat'=>' d MMMM yyyy г.',
                    'locale'=>'ru'],

                'attributes' => [
                    'id',

                    'email:email',
                    'birthday:date',
                    'passportSeria',
                    'passportNumber',
                    'passportInfo:ntext',
                    'passportDate:date',
                    'inn',
                    'address:ntext',
                    'phone1',
                    'phone2',
                    'phone3',


                ],
            ]) ?></td>


    </tr>
</table>

<hr>

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
