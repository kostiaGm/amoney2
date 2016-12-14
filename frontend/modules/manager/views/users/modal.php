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


    <?php //  echo $this->render('_searchModal', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::button(Yii::t('app', 'Select'), ['class'=>'btn btn-success', 'onclick'=>'chooseUser('.$data->id.')']);
                } ,
                'filter' => false
            ],
/*

            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img($data->getPhoto(), ["width"=>"80", "height"=>"80"]);
                }
            ], */

            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->lastname.' '.$data->username.' '.$data->patronymic;
                },
                'filter' => Html::textInput("UserSearch[user]", '', ['class'=>'form-control'])
            ],

             'email:email',
         //    'status',
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
             'phone1',
            // 'phone2',
            // 'phone3',
            // 'role',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) use ($isModal) {

                    $url ='/manager/users/'.$action.'?id='.$model->id.($isModal ? '&layout=modal' : '');


                    return $url;
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
