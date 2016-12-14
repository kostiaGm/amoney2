<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
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
            <?php if (!empty(($photo = $model->getPhoto()))): ?>
                <img class="img-thumbnail" data-src="holder.js/140x140" alt="<?= $this->title ?>" style="width: 445px; height: 445px;" src="<?= $photo ?>" data-holder-rendered="true">

            <?php else: ?>
                <img class="img-thumbnail" data-src="holder.js/140x140" alt="<?= $this->title ?>" style="width: 445px; height: 445px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNThkYjNiYzAyMiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OGRiM2JjMDIyIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ1LjUiIHk9Ijc0LjgiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true">

            <?php endif; ?>

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
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'layout' => ($isModal ? 'modal' : 'main')], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'layout' => ($isModal ? 'modal' : 'main')], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="clearfix"></div>
    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'agreementId',
                'format' => 'raw',
                'value' => function($data) {
                    $agreement = \common\models\Agreement::findOne($data->agreementId);
                    if ($agreement) {
                        return Html::a($agreement->name, ['/manager/agreement/view', 'id'=>$agreement->id], ["target"=>"_blank"]);
                    }
                }
            ],

            'type',
            'text',
            'createdAt',
            'sum',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
