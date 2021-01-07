<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */

$this->title = 'Update Autor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="autor-update">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
