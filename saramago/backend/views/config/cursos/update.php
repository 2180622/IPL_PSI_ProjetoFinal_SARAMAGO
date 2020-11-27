<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\curso */

$this->title = 'Update Curso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="curso-update">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>