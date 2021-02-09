<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ConsultaTReal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Consulta T Reals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="consulta-treal-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dataHoraInicial',
            'dataHoraFinal',
            'operador',
            'Leitor_id',
            'Exemplar_id',
        ],
    ]) ?>

</div>