<?php

use common\models\Estatutoexemplar;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = $model->titulo . ' ('. $model->ano .')';
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="site-cat obra-view">
    <div class="grid-container">
        <div class="menu-info-saramago">
            <?php
            if ($model->imgCapa != null)
            {
                echo Html::img('@web/img/' . $model->imgCapa,['width' => '100%', 'alt'=> $model->titulo . ' ('. $model->ano .')']);
            }

            echo'<h4>'.$model->titulo.' <small class="text-muted"> ('.$model->ano.')</small></h4><hr>';

            if($model->tipoObra == "materialAv")
            {
                echo '<p>Tipo de Obra: Material Audio-Visual</p>';
                echo '<p> Duração: '.$model->materialavs->duracao.' min.</p>';
                echo '<p> EAN: '.$model->materialavs->ean.'</p>';
            }
            if($model->tipoObra == "monografia")
            {
                echo '<p>Tipo de Obra: Monografia</p>';
                echo '<p> Volume: '.$model->monografias->volume.'</p>';
                echo '<p> Páginas: '.$model->monografias->paginas.'</p>';
                echo '<p> ISBN: '.$model->monografias->ISBN.'</p>';
            }
            elseif($model->tipoObra == "pubPeriodica")
            {
                echo '<p>Tipo de Obra: Publicação Periódica</p>';
                echo '<p> Volume: '.$model->pubperiodicas->volume.'</p>';
                echo '<p> Série: '.$model->pubperiodicas->serie.'</p>';
                echo '<p> Número: '.$model->pubperiodicas->duracao.'</p>';
                echo '<p> ISNN: '.$model->pubperiodicas->ISNN.'</p>';
            }

            echo'<p>Ano: '.$model->ano.'</p><br>';
            echo'<p>Data Registado: '.Yii::$app->formatter->asDatetime($model->dataRegisto).'</p>';
            echo'<p>Data Atualizado: '.Yii::$app->formatter->asDatetime($model->dataAtualizado).'</p>';
            ?>
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('pencil-alt') . ' Editar',
                ['value' => 'obra-update?scenario='.$model->tipoObra.'&id='.$model->id, 'class' => 'btn btn-alt','id' => 'modalButtonObraUpdate']) ?>
            <?= Html::a(Html::button(FAS::icon('trash-alt').' Apagar', ['class' => 'btn btn-alt ']), Url::to(['obra-delete', 'id' => $model->id]),
                ['data' =>
                    ['confirm' => 'Tem a certeza de que pretende apagar a obra "' . $model->titulo .'" ('.$model->ano.')' . '?',
                        'method' => 'post']
                ]);
            ?>

            <?= Html::button(FAS::icon('plus') . ' Adicionar Exemplar',
                ['value' => 'exemplar-create?idObra='.$model->id.'&tipoObra='.$model->tipoObra,
                    'class' => 'btn btn-alt pull-right','id' => 'modalButtonExemplarCreate']) ?>

            <?= Html::button(FAS::icon('plus') . ' Associar Autor',
                ['value' => 'autor-associate?idObra='.$model->id, 'class' => 'btn btn-alt pull-right','id' => 'modalButtonAutorAssociate']) ?>

        </div>
        <div class="menu-table-saramago">
            <?php
            Pjax::begin();
            echo Tabs::widget([
                    'items' =>[
                        //region Ficha da Obra
                        [
                            'label' => 'Ficha da Obra',
                            'content' => DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    [
                                        'attribute' => 'id',
                                        'label' => 'Nº do Sistema',
                                    ],
                                    'imgCapa',
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
                                    'preco',
                                    [
                                        'label'=>'Data Registo',
                                        'attribute'=>'dataRegisto',
                                        'value'=> function ($model) {return Yii::$app->formatter->asDatetime($model->dataRegisto);}
                                    ],
                                    [
                                        'label'=>'Data Atualizado',
                                        'attribute'=>'dataAtualizado',
                                        'value'=> function ($model) {return Yii::$app->formatter->asDatetime($model->dataAtualizado);}
                                    ],
                                    [
                                        'label'=>'Classificação Decimal Universal',
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
                        //region Autores
                        [
                            'label' => 'Autores '. Html::tag('span', $model->getAutors()->count(), ['class'=>'badge badge-light']),
                            'encode'=> false,
                            'content'=> '<br>'.GridView::widget([
                                'dataProvider' => $dataProviderAutor,
                                'filterModel' => $searchModelAutor,
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'label'=>'Autor',
                                            'attribute'=>'Autor_id',
                                            'value' => function ($model)
                                            {
                                                $autor = $model->autor->primeiroNome.' '.$model->autor->segundoNome.' '.$model->autor->apelido;
                                                return $autor;
                                            }
                                        ],
                                        ['class' => 'yii\grid\ActionColumn',
                                            'header' => 'Ações',
                                            'contentOptions' => ['style' => 'vertical-align: middle;'],
                                            'template' => ' {view} {delete}',
                                            'buttons' => [
                                                'view' => function ($url, $model, $id) {
                                                    return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                        ['value' => Url::to(['autor-view', 'id' => $model->autor->id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonAutorView'.$model->autor->id]);
                                                },
                                                'delete' => function ($url, $model, $id) {
                                                    $autor = $model->autor->primeiroNome.' '.$model->autor->segundoNome.' '.$model->autor->apelido;
                                                    return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['autor-disassociate', 'idAutor' => $model->autor->id, 'idObra'=> $model->obra->id]),
                                                        ['data' =>
                                                            ['confirm' => 'Tem a certeza de que pretende desassociar o autor "' . $autor . '" da obra?', 'method' => 'post']
                                                        ]);
                                                },
                                            ],
                                        ],
                                    ],
                                ]),
                        ],
                        //endregion
                        //TODO ANALÍTICO
                        //region Exemplares
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
                                    //FIXME FUNDO - Exemplar é que recebe o fundo_id / não o contrario
                                    /*[
                                        'label' => 'Fundo',
                                        'attribute' => 'Fundo_id',
                                        'value' => function ($model) {
                                            return $model->fundos->designacao;
                                        },
                                        'filter' => ['normal' => 'Normal', 'curto' => 'Curto', 'diario' => 'Diário', 'nreq' => 'Não Requisitável'],
                                        'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                        'headerOptions' => ['width' => '200'],
                                    ],*/
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
                                ]]),
                            ],

                        //endregion
                    ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);

            Pjax::end();
            ?>

        </div>
    </div>

<?php
    $this->registerJs( /**@lang JavaScript*/"
        $(function () {
            $('#modalButtonObraUpdate').click(function (){
                $('#modalObraUpdate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        $(function () {
            $('#modalButtonExemplarCreate').click(function (){
                $('#modalExemplarCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        $(function () {
            $('#modalButtonAutorAssociate').click(function (){
                $('#modalAutorAssociate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        <!-- 
        $(function () {
            $('#modalButtonAnaliticoCreate').click(function (){
                $('#modalAnaliticoCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        -->
    ");

    foreach ($model->exemplars as $exemplar)
    {
        $this->registerJs(/**@lang JavaScript*/"
            $(function () {
                $('#modalButtonExemplarView" . $exemplar->id . "').click(function (){
                    $('#modalExemplarView" . $exemplar->id . "').modal('show')
                        .find('#modalContent')
                        .load($(this).attr('value'))
                })
            });
            
            $(function () {
                $('#modalButtonExemplarUpdate" . $exemplar->id . "').click(function (){
                    $('#modalExemplarUpdate" . $exemplar->id . "').modal('show')
                        .find('#modalContent')
                        .load($(this).attr('value'))
                })
            });
        ");
    }

    foreach ($model->autors as $autor)
    {
        $this->registerJs(/**@lang JavaScript*/"
            $(function () {
                $('#modalButtonAutorView" . $autor->id . "').click(function (){
                    $('#modalAutorView" . $autor->id . "').modal('show')
                        .find('#modalContent')
                        .load($(this).attr('value'))
                })
            });
        ");
    }
?>

    <?php

        Modal::begin([
            'header' => '<h3>Adicionar Exemplar</h3>',
            'id' => 'modalExemplarCreate',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h3>Associar Autor</h3>',
            'id' => 'modalAutorAssociate',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        /*Modal::begin([
            'header' => '<h3>Adicionar Analítico</h3>',
            'id' => 'modalAnaliticoCreate',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();*/

        Modal::begin([
            'header' => '<h3>'.$model->titulo.'</h3>',
            'id' => 'modalObraUpdate',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    ?>

    <?php
    foreach ($model->exemplars as $exemplar)
    {
        Modal::begin([
            'header' => '<h4>'.$exemplar->cota.' <small class="text-muted"> '.$exemplar->codBarras.'</small></h4>',
            'id' => 'modalExemplarView'.$exemplar->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$exemplar->cota.' <small class="text-muted"> '.$exemplar->codBarras.'</small></h4>',
            'id' => 'modalExemplarUpdate'.$exemplar->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

    <?php
    foreach ($model->autors as $autor)
    {
        Modal::begin([
            'header' => '<h4>'.$autor->primeiroNome.' '.$autor->segundoNome.' '. $autor->apelido.'</h4>',
            'id' => 'modalAutorView'.$autor->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

</div>
