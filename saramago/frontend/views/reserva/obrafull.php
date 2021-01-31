<?php

use rmrevin\yii\fontawesome\FAS;
use common\models\Estatutoexemplar;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalhes da obra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova reserva', ['obrafull'], ['class' => 'btn btn-create']) ?>
    </p>
    <?php 
        echo '<h1>Reservas</h1>';
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Exemplares '. Html::tag('span', $model->getExemplars()->count(), ['class'=>'badge badge-light']),
                    'encode'=> false,
                    'active'=> true,
                    'content'=> GridView::widget([
                        'dataProvider' => $dataProviderExemplar,
                        'filterModel' => $searchModelExemplar,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute' => 'cota',
                                'headerOptions' => ['width' => '150']
                            ],
                            [
                                'label' => 'Cód. Barras',
                                'attribute' => 'codBarras',
                                'headerOptions' => ['width' => '150']
                            ],
                            [
                                'label' => 'Tipo',
                                'attribute' => 'TipoExemplar_id',
                                'value' => function ($model)
                                {
                                    return $model->tipoExemplar->designacao;
                                },
                                'filter' => $tipoExemplarAll["$model->tipoObra"],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'headerOptions' => ['width' => '200']
                            ],
                            [
                                'label' => 'Estatuto',
                                'attribute' => 'EstatutoExemplar_id',
                                'value' => function ($model)
                                {
                                    return $model->estatutoExemplar->estatuto;
                                },
                                'filter' => Estatutoexemplar::EST_EXEMPLAR,
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'headerOptions' => ['width' => '200'],
                            ],
                            [
                                'label' => 'Fundo',
                                'attribute' => 'Fundo_id',
                                'value' => function ($model) {
                                    if (isset($model->fundo->designacao)) {
                                        return $model->fundo->designacao;
                                    }
                                    else {
                                        return 'Sem fundo atribuído';
                                    }
                                },
                                'filter' => ['normal' => 'Normal', 'curto' => 'Curto', 'diario' => 'Diário', 'nreq' => 'Não Requisitável'],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'headerOptions' => ['width' => '200'],
                            ],
                            [
                                'label' => 'Suplemento?',
                                'attribute' => 'suplemento',
                                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Ambos'],
                                'filter' => ['0' => 'Não', '1' => 'Sim'],
                                'headerOptions' => ['width' => '100']
                            ],
                            [
                                'label' => 'Biblioteca',
                                'attribute' => 'Biblioteca_id',
                                'filter' => $bibliotecaAll,
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'value' => function ($model)
                                {
                                    return $model->biblioteca->nome;
                                }
                            ],
                            [
                                'label' => 'Estado',
                                'attribute' => 'estado',
                                'format' => 'html',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
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
                                'filter' => [
                                    'arrumacao' => 'Em Arrumação...',
                                    'estante'=>'Na Estante',
                                    'quarentena'=>'Quarentena',
                                    'perdido'=>'Perdido',
                                    'reservado'=>'Reservado',
                                    'emprestado'=>'Emprestado',
                                    'transferencia'=>'Transferência',
                                    'nd'=>'Não Disponível',
                                ],
                                'headerOptions' => ['width' => '100'],
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Ações',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'template' => '{view} {pedir} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['exemplar-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonExemplarView' . $id]);
                                    },
                                    'update' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['exemplar-update', 'id' => $id, 'tipoObra'=>$model->obra->tipoObra]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonExemplarUpdate' . $id]);
                                    },
                                    'pedir' => function ($url, $model, $id) {
                                        return Html::a(Html::button(FAS::icon('running')->size(FAS::SIZE_LG),
                                            ['class' => 'btn btn-success btn-sm inline']), Url::to(['exemplar-pedir', 'id' => $id]),
                                            ['data' =>
                                                ['confirm' => "Está prestes a enviar um pedido de levantamento do exemplar:\n\nCota: " . $model->cota .
                                                    "\nCód.Barras: ".$model->codBarras."\nObra: ".$model->obra->titulo ." (".$model->obra->ano.')'."\n\nPretende prosseguir?", 'method' => 'post']
                                            ]);
                                    },
                                    'delete' => function ($url, $model, $id) {
                                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['exemplar-delete', 'id' => $id]),
                                            ['data' =>
                                                ['confirm' => 'Tem a certeza de que pretende apagar o exemplar ' . $model->cota . '?', 'method' => 'post']
                                            ]);
                                    },
                                ],
                            ],
                        ],
                    ]),
                ],

                            //endregion
                [
                    'label' => 'Postos de trabalho ',
                    'content' => 'Anim pariatur cliche...',
                ],
                [
                    'label' => 'Example',
                    'url' => 'http://www.example.com',
                ],
            ],
        ]);

    ?>
</div>