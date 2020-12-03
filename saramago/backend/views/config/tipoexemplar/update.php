<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoexemplar */

$this->title = 'Update Tipoexemplar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipoexemplars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipoexemplar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
