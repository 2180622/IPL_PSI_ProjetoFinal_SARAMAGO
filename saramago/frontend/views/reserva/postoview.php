<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservas', 'url' => ['posto']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['post-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['post-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Pretende apagar esta reserva de posto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dataReserva',
            'estadoReserva',
            'dataFecho',
            'notaReserva:ntext',
            'Leitor_id',
            'Exemplar_id',
        ],
    ]) ?>

</div>
