<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Agreement */

$this->title = Yii::t('app', 'Create') .' '.Yii::t('app', 'Agreement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<?php
Modal::begin([
    'id' => 'user-modal',
    'toggleButton' => [
        'label' => '<i class="glyphicon glyphicon-user"></i> '.Yii::t('app', 'Select User'),
        'class' => 'btn btn-success'
    ],

    'closeButton' => [
        'label' => 'Close',
        'class' => 'btn btn-danger btn-sm pull-right',
    ],
    'size' => 'modal-lg',
]);

?>

<iframe src="/manager/users/modal?layout=modal" width="100%" height="450" frameborder="0" ></iframe>

<?php
Modal::end();
?>
<div class="agreement-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
