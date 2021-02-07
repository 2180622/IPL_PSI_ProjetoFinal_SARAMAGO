<?php

use rmrevin\yii\fontawesome\FAS;
use common\models\Estatutoexemplar;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->titulo . ' ('. $model->ano .')';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisar obras', 'url' => ['pesquisa/obra']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obra-full saramago-table ">
    <div class="center-block" style="text-align: -webkit-center;">
        <?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>
    </div>
    <div> 
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="menu-info-saramago col-lg-3 panel-default fast-font">
            <?php
            if ($model->imgCapa != null)
            {
                echo Html::img('@web/img/' . $model->imgCapa,['height' => '300px', 'width' => '200px', 'alt'=> $model->titulo . ' ('. $model->ano .')']);
            }
            echo '<br>';
            if($model->tipoObra == "materialAv")
            {
                echo '<p> Tipo: Material Audio-Visual</p>';
                echo '<p> Duração: '.$model->materialavs->duracao.' min.</p>';
                echo '<p> EAN: '.$model->materialavs->ean.'</p>';
            }
            if($model->tipoObra == "monografia")
            {
                echo '<p> Tipo: Monografia</p>';
                echo '<p> Volume: '.$model->monografias->volume.'</p>';
                echo '<p> Páginas: '.$model->monografias->paginas.'</p>';
                echo '<p> ISBN: '.$model->monografias->isbn.'</p>';
            }
            elseif($model->tipoObra == "pubPeriodica")
            {
                echo '<p> Tipo: Publicação Periódica</p>';
                echo '<p> Volume: '.$model->pubperiodicas->volume.'</p>';
                echo '<p> Série: '.$model->pubperiodicas->serie.'</p>';
                echo '<p> Número: '.$model->pubperiodicas->numero.'</p>';
                echo '<p> ISNN: '.$model->pubperiodicas->ISSN.'</p>';
            }

            echo'<p>Ano: '.$model->ano.'</p><br>';
            ?>

        </div>
        <div class="hidden-scroll col-lg-auto">
        <?php 
            echo Tabs::widget([
                'items' => [
                          //exemplares region
                    [
                        'label' => 'Exemplares '. Html::tag('span', $model->getExemplars()->count(), ['class'=>'badge badge-light']),
                        'encode'=> false,
                        'active'=> true,
                        'content'=> GridView::widget([
                            'dataProvider' => $dataProviderExemplar,
                            'filterModel' => $searchModelExemplar,
                            'options' => ['style' => 'table-layout:fixed;'],
                            'columns' => [
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Pedir',
                                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                                    'template' => '{pedir}',
                                    'buttons' => [
                                        'pedir' => function ($url, $model, $id) {
                                            if ($model->estado == 'emprestado' || $model->estado =='reservado' || $model->estado == 'transferecia') {
                                                return Html::a(Html::button(FAS::icon('hand-holding')->size(FAS::SIZE_LG),
                                                    ['class' => 'btn btn-info btn-sm inline']), Url::to(['exemplar-reserva', 'id' => $model->id]),
                                                    ['data' =>
                                                        ['confirm' => "Está prestes a enviar um pedido de reserva do exemplar:\n\nCota: " . $model->cota .
                                                            "\nCód.Barras: ".$model->codBarras."\nObra: ".$model->obra->titulo ." (".$model->obra->ano.')'."\n\nPretende prosseguir?", 'method' => 'post']
                                                    ]);
                                            }
                                            else {
                                                return '';
                                            }
                                        },
                                    ],
                                ],
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
                                            return '';
                                        }
                                    },
                                    'filter' => ['normal' => 'Normal', 'curto' => 'Curto', 'diario' => 'Diário', 'nreq' => 'Não Requisitável'],
                                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                    'headerOptions' => ['width' => '200'],
                                ],
                                [
                                    'label' => 'Suplemento',
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
                            ],
                        ]),
                    ],

                                //endregion
                    //region Ficha da Obra
                        [
                            'label' => 'Ficha da obra',
                            'content' => DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'titulo',
                                    [
                                        'attribute' => 'resumo',
                                        'label' => 'Resumo',
                                        'format' => 'html',
                                    ],
                                    'editor',
                                    'ano',
                                    [
                                        'attribute' => 'tipoObra',
                                        'label' => 'Tipo de Obra',
                                        'value'=> function ($model, $value)
                                        {
                                            if($model->tipoObra == "materialAv") {return 'Material Audio-Visual';}
                                            if($model->tipoObra == "monografia") {return 'Monografia';}
                                            elseif($model->tipoObra == "pubPeriodica") {return 'Publicação Periódica';}
                                        }
                                    ],
                                    [
                                        'attribute' => 'descricao',
                                        'label' => 'Descrição',
                                    ],
                                    'local',
                                    'edicao',
                                    'assuntos',
                                    [
                                        'label'=>'CDU',
                                        'attribute'=>'Cdu_id',
                                        'value' => function ($model) { return $model->cdu->codCdu.' ('. $model->cdu->designacao.')';}
                                    ],
                                    [
                                        'label'=>'Coleção',
                                        'attribute'=>'Colecao_id',
                                        'value' => function ($model) {
                                            if($model->colecao != null) {return $model->colecao->tituloColecao;}}
                                    ],
                                ],
                            ]),
                        ],
                        //endregion

                ],
            ]);
        ?>
        </div>
    </div>
    
</div>