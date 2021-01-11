<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Reservasposto */

$this->title = 'Reserva nº: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservaspostos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="site-pto reserva-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if($model->estadoReserva == 'reservado'){
            echo '<h3 class="pull-right"><span class="label label-success">Reservado</span></h3>';
        }elseif($model->estadoReserva == 'concluido'){
            echo '<h3 class="pull-right"><span class="label label-info">Concluído</span></h3>';
        }elseif($model->estadoReserva == 'concluido'){
            echo '<h3 class="pull-right"><span class="label label-danger">Cancelado</span></h3>';
        }
    ?>

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => [
            [
                'attribute'=>'dataPedido',
                'label'=>'Data Pedido',
                'value' => function ($model)
                    {
                        $formatter = Yii::$app->formatter;
                        return $formatter->asDatetime($model->dataPedido, 'long');
                    }
            ],
            [
                'attribute'=>'dataReserva',
                'label'=>'Data Reserva',
                'value' => function ($model)
                    {
                        $formatter = Yii::$app->formatter;
                        return $formatter->asDatetime($model->dataPedido, 'long');
                    }
            ],
            [   'attribute'=> 'Leitor_id',
                'label'=>'Leitor',
                'format' => 'html',
                'value' => function ($model) { return Html::a($model->leitor->nome, ['leitor/view-full', 'id' => $model->id]);}
            ],
            'lugar',
            [   'attribute'=> 'PostoTrabalho_id',
                'label'=>'Posto de Trabalho',
                'format' => 'html',
                'value' => function ($model) { return $model->postoTrabalho->designacao;}
            ],
            'notaOpac:html',
            'notaInterna:html',
            'operador',
        ],
    ]) ?>

</div>
