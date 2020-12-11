<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cdu */

$this->title = 'Update Cdu: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cdus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cdu-update">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
