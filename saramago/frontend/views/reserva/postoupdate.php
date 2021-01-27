<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = 'Modificar reserva de posto de trabalho: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['posto']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['posto-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="posto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('posto/_form', [
        'model' => $model,
    ]) ?>

</div>
