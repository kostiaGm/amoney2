<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->lastname.' '.$data->username.' '.$data->patronymic;
                }
            ],

             'email:email',
             'status',
            // 'created_at',
            // 'updated_at',
            // 'lastname',
            // 'patronymic',
            // 'photo',
            // 'birthday',
            // 'passportSeria',
            // 'passportNumber',
            // 'passportInfo:ntext',
            // 'passportDate',
            // 'inn',
            // 'address:ntext',
            // 'phone1',
            // 'phone2',
            // 'phone3',
            // 'role',

            [
                'class' => 'yii\grid\ActionColumn',

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
