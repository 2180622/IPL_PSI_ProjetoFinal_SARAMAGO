<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Noticias */

$this->title = 'Update Noticias: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="noticias-update">

    <?= $this->render('_form', ['model' => $model, 'identity' => $identity]) ?>

</div>
