<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exemplares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="exemplar-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nº do Sistema',
                'attribute' => 'id',
            ],
            'cota',
            'codBarras',
            [
                'label' => 'Suplemento?',
                'attribute' => 'suplemento',
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'TipoExemplar_id',
                'value' => function ($model)
                {
                    return $model->tipoExemplar->designacao;
                },
            ],
            [
                'label' => 'Estado',
                'attribute' => 'estado',
                'format' => 'html',
                'value' => function ($model)
                {
                    if($model->estado == 'arrumacao'){ return '<h4><span class="label label-info">Em Arrumação...</span></h4>';}
                    elseif($model->estado == 'estante'){return '<h4><span class="label label-success">Na Estante</span></h4>';}
                    elseif($model->estado == 'quarentena'){return '<h4><span class="label label-warning">Em Quarentena</span></h4>';}
                    elseif($model->estado == 'perdido'){return '<h4><span class="label label-danger">Perdido</span></h4>';}
                    elseif($model->estado == 'reservado'){return '<h4><span class="label label-info">Reservado</span></h4>';}
                    elseif($model->estado == 'emprestado'){return '<h4><span class="label label-info">Emprestado</span></h4>';}
                    elseif($model->estado == 'transferecia'){return '<h4><span class="label label-info">Transferência</span></h4>';}
                    elseif($model->estado == 'nd'){return '<h4><span class="label label-danger">Não Disponível</span></h4>';}
                },
            ],
            [
                'label' => 'Fundo',
                'attribute' => 'Fundo_id',
                'value' => function ($model)
                {
                   if($model->fundo != null) {return $model->fundo->designacao;}
                }
            ],
            [
                'label' => 'Biblioteca',
                'attribute' => 'Biblioteca_id',
                'value' => function ($model)
                {
                    return $model->biblioteca->nome.' ('.$model->biblioteca->codBiblioteca.')';
                }
            ],
            [
                'label' => 'Estatuto',
                'attribute' => 'EstatutoExemplar_id',
                'format'=>'html',
                'value' => function ($model)
                {
                    if($model->estatutoExemplar->id == '1')
                    {
                        return 'Normal<br><small class="text-muted">Prazo: Consoante o estatuto do leitor.</small>';
                    }
                    elseif ($model->estatutoExemplar->id == '2')
                    {
                        return 'Curto<br><small class="text-muted">Prazo: '.$model->estatutoExemplar->prazo.' dias. </small>';
                    }
                    elseif ($model->estatutoExemplar->id == '3')
                    {
                        return 'Diário<br><small class="text-muted">Prazo: '.$model->estatutoExemplar->prazo.' dias. </small>';
                    }
                    else
                    {
                        return 'Não Requisitável';
                    }
                },
                //'filter' => ['normal' => 'Normal', 'curto' => 'Curto', 'diario' => 'Diário', 'nreq' => 'Não Requisitável'],
            ],
            [
                'label'=>'Nota Interna',
                'attribute' => 'notaInterna',
                'value'=> function ($model)
                {
                    if($model->notaInterna == null){ return null;}else{return $model->notaInterna;}
                }
            ],
        ],
    ]);
    ?>

</div>
