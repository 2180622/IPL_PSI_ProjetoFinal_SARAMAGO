<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = 'Modificar reserva de exemplar: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['exemplar']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['exemplar-view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="exemplar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('exemplar/_form', [
        'model' => $model,
    ]) ?>

</div>
