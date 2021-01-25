    <?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Catálogo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cat">
    <?php
    if($obrasTotalCount == 0){
        echo '<div class="alert alert-info config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Comece por registar as suas obras.
              </div>';
    }?>
    <div class="grid-container">
        <div class="menu-search-saramago">
            <?php Pjax::begin(); ?>
            <?php echo $this->renderAjax('_search', ['model' => $ObraSearchModel, 'cduAll'=>$cduAll, 'colecaoAll'=>$colecaoAll]) ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="menu-nav-saramago">
            <?= ButtonDropdown::widget([
                'label' => FAS::icon('book') . ' Adicionar Obras',
                'encodeLabel' => false,
                'options' => ['class' => 'btn btn-alt dropdown-toggle'],
                'dropdown' => [
                    'encodeLabels' => false,
                    'options' => ['class' => 'dropdown-menu-right'],
                    'items' => [
                        [
                            'label' => FAS::icon('plus') . ' Adicionar Material Audio-Visual',
                            'options' => ['value' => 'cat/obra-create?scenario=materialAv', 'class' => 'btn btn-secondary',
                                'id' => 'modalButtonObraMaterialavCreate']
                        ],
                        [
                            'label' => FAS::icon('plus') . ' Adicionar Monografia',
                            'options' => ['value' => 'cat/obra-create?scenario=monografia', 'class' => 'btn btn-secondary',
                                'id' => 'modalButtonObraMonografiaCreate']
                        ],
                        [
                            'label' => FAS::icon('plus') . ' Adicionar Publicação Periodica',
                            'options' => ['value' => 'cat/obra-create?scenario=pubPeriodica', 'class' => 'btn btn-secondary',
                                'id' => 'modalButtonObraPubperiodicaCreate']
                        ],
                    ],
                ],
                ]);
            ?>
            <?= ButtonDropdown::widget([
                'label' => FAS::icon('users') . ' Autores',
                'encodeLabel' => false,
                'options' => ['class' => 'btn btn-alt dropdown-toggle'],
                'dropdown' => [
                    'encodeLabels' => false,
                    'options' => ['class' => 'dropdown-menu-right'],
                    'items' => [
                        [
                            'label' => FAS::icon('plus') . ' Adicionar Autor',
                            'options' => ['value' => 'cat/autor-create', 'class' => 'btn btn-secondary',
                                'id' => 'modalButtonAutorCreate']
                        ],
                    ],
                ],
                ]);
            ?>
            <?= Html::button(FAS::icon('plus') . ' Adicionar Coleção',
                ['value' => 'cat/colecao-create',  'class' => 'btn btn-alt','id' => 'modalButtonColecaoCreate']) ?>
        </div>
        <div class="menu-table-saramago">
            <?php Pjax::begin(); ?>
            <?php
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Obras',
                        'options' => ['id' => 'tabObras'],
                        'content' => '<br>'.
                            GridView::widget([
                            'dataProvider' => $ObraDataProvider,
                            'filterModel' => $ObraSearchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'label' => 'Título',
                                    'attribute' => 'titulo',
                                    'format' => 'html',
                                    'value' => function ($model) { return Html::a($model->titulo .' '. FAS::icon('external-link-alt')->size(FAS::SIZE_EXTRA_SMALL), ['obra-full', 'id' => $model->id]);}
                                ],
                                'editor',
                                'edicao',
                                [
                                    'label' => 'Coleçao',
                                    'attribute' => 'Colecao_id',
                                    'headerOptions' => ['width' => '100'],
                                    'filter' => $colecaoAll,
                                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todas'],
                                    'value'=> function ($model)
                                    {
                                        if($model->colecao != null)
                                        {
                                            return $model->colecao->tituloColecao;
                                        }
                                    }
                                ],
                                [
                                    'label' => 'CDU',
                                    'attribute' => 'Cdu_id',
                                    'headerOptions' => ['width' => '100'],
                                    'filter' => $cduAll,
                                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                    'value' => function ($model) {return $model->cdu->codCdu;}
                                ],
                                [
                                    'label' => 'Autores',
                                    'attribute' => 'autor',
                                    'format' => 'html',
                                    'value' =>  function ($model)
                                    {
                                        $autores[]=null;

                                        foreach ($model->autors as $autor) {

                                            $autores[] = $autor->apelido . ', ' . substr($autor->primeiroNome, - strlen($autor->primeiroNome), 1).'; ';
                                        
                                        }   
                                        return implode($autores);
                                    },
                                ],
                                [
                                    'label' => 'Ano',
                                    'attribute' => 'ano',
                                    'headerOptions' => ['width' => '80'],
                                ],
                                [
                                    'attribute' => 'tipoObra',
                                    'label' => 'Tipo',
                                    'filter' => [
                                        'materialAv'=>'Material Audio-Visual',
                                        'monografia'=> 'Monografia',
                                        'pubPeriodica'=>'Publicação Periódica'],
                                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                    'value' => function ($model)
                                    {
                                        if($model->tipoObra == 'materialAv'){ return 'Material Audio-Visual';}
                                        elseif ($model->tipoObra == 'monografia'){return 'Monografia';}
                                        elseif ($model->tipoObra == 'pubPeriodica'){return 'Publicação Periódica';}
                                    }
                                ],
                                [
                                    'label'=>'Exemplares',
                                    'value' => function ($model) {return $model->getExemplars()->count();}
                                ],
                                //'assuntos',
                                //'preco',
                                //'dataRegisto',
                                //'dataAtualizado',
                                //'Cdu_id',
                                //'Colecao_id',
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Ação',
                                    'template' => '{view}',
                                    'buttons' => [
                                        'view' => function ($url, $model, $id)
                                        {
                                            return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                ['value' => Url::to(['obra-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonObraView' . $id]);
                                        },
                                    ],
                                ],
                            ]]),
                    ],
                    [
                        'label' => 'Autores',
                        'options' => ['id' => 'tabAutores'],
                        'content'=> '<br>'.
                            GridView::widget([
                                    'dataProvider' => $AutorDataProvider,
                                    'filterModel' => $AutorSearchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'primeiroNome',
                                    'segundoNome',
                                    'apelido',
                                    [
                                        'attribute' => 'tipo',
                                        'label' => 'Tipo',
                                        'filter' => ['individual'=>'Individual','coletivo'=>'Coletivo'],
                                        'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                        'value' => function ($model)
                                        {
                                            if($model->tipo == "individual"){return 'Individual';}
                                            else{return 'Coletivo';}
                                        }
                                    ],
                                    [
                                        'attribute' => 'orcid',
                                        'label' => 'ORCid',
                                        'format' => 'html',
                                        'value' => function ($model)
                                        {
                                            $p1 = substr($model->orcid, 0, 4);
                                            $p2 = substr($model->orcid, 4, 4);
                                            $p3 = substr($model->orcid, 8, 4);
                                            $p4 = substr($model->orcid, 12, 4);
                                            $orcid = $p1.'-'.$p2.'-'.$p3.'-'.$p4;
                                            return Html::a($orcid.' '.FAS::icon('external-link-alt')->size(FAS::SIZE_EXTRA_SMALL), 'https://orcid.org/'.$orcid);
                                        }

                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'header' => 'Ações',
                                        'template' => '{view} {update} {delete}',
                                        'buttons' => [
                                            'view' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['autor-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonAutorView' . $id]);
                                            },
                                            'update' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['autor-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonAutorUpdate' . $id]);
                                            },
                                            'delete' => function ($url, $model, $id) {
                                                $autor = $model->primeiroNome.' '.$model->segundoNome.' '.$model->apelido;
                                                return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                                    ['class' => 'btn btn-danger btn-sm inline']), Url::to(['autor-delete', 'id' => $id]),
                                                    ['data' =>
                                                        ['confirm' => "Tem a certeza de que pretende apagar o autor:\n" .$autor . ' ?', 'method' => 'post']
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                            ])
                    ],
                    //#region Coleções
                    [
                        'label' => 'Coleções',
                        'options' => ['id' => 'tabColecoes'],
                        'content'=> '<br>'.GridView::widget([
                                'dataProvider' => $ColecaoDataProvider,
                                'filterModel' => $ColecaoSearchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'tituloColecao',
                                        'label' => 'Titulo',
                                    ],
                                    [
                                        'label' => 'Obras Agregadas',
                                        'value' => function ($model)
                                        {
                                            return $model->getObras()->count();
                                        }
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'header' => 'Ações',
                                        'headerOptions' => ['width' => '100'],
                                        'template' => '{view} {update} {delete}',
                                        'buttons' => [
                                            'view' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['colecao-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonColecaoView' . $id]);
                                            },
                                            'update' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['colecao-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonColecaoUpdate' . $id]);
                                            },
                                            'delete' => function ($url, $model, $id) {
                                                return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                                    ['class' => 'btn btn-danger btn-sm inline']), Url::to(['colecao-delete', 'id' => $id]),
                                                    ['data' =>
                                                        ['confirm' => "Tem a certeza de que pretende apagar a coleção:\n".'"'.$model->tituloColecao . '" ?', 'method' => 'post']
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                        ]),
                    ],
                    //#endregion
                ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>

            <?php
            foreach ($obrasModel as $obra) {
                $this->registerJs("
                    $(function () {
                    $('#modalButtonObraView" . $obra->id . "').click(function (){
                        $('#modalObraView" . $obra->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
    
                $(function () {
                    $('#modalButtonObraUpdate" . $obra->id . "').click(function (){
                        $('#modalObraUpdate" . $obra->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
                ");
            }
            ?>

            <?php
            foreach ($autorModel as $autor) {
                $this->registerJs("
                    $(function () {
                    $('#modalButtonAutorView" . $autor->id . "').click(function (){
                        $('#modalAutorView" . $autor->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
    
                $(function () {
                    $('#modalButtonAutorUpdate" . $autor->id . "').click(function (){
                        $('#modalAutorUpdate" . $autor->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
                ");
            }
            ?>

            <?php
            foreach ($colecaoModel as $colecao) {
                $this->registerJs("
                    $(function () {
                    $('#modalButtonColecaoView" . $colecao->id . "').click(function (){
                        $('#modalColecaoView" . $colecao->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
    
                $(function () {
                    $('#modalButtonColecaoUpdate" . $colecao->id . "').click(function (){
                        $('#modalColecaoUpdate" . $colecao->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
                ");
            }
            ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
    <br>

    <?php
    $this->registerJs( /**@lang JavaScript */"
        $(function () {
            $('#modalButtonObraMaterialavCreate').click(function (){
                $('#modalObraCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'));  
            })
        });
        
        $(function () {
            $('#modalButtonObraMonografiaCreate').click(function (){
                $('#modalObraCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'));
            })
        });
        
        $(function () {
            $('#modalButtonObraPubperiodicaCreate').click(function (){
                $('#modalObraCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonAutorCreate').click(function (){
                $('#modalAutorCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonColecaoCreate').click(function (){
                $('#modalColecaoCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");

    ?>

    <?php
    Modal::begin([
        'header' => '<h3>Nova Obra</h3>',
        'id' => 'modalObraCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    Modal::begin([
        'header' => '<h3>Novo Autor</h3>',
        'id' => 'modalAutorCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    Modal::begin([
        'header' => '<h3>Nova Coleção</h3>',
        'id' => 'modalColecaoCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($obrasModel as $obra) {

        Modal::begin([
            'header' => '<h4>'.$obra->titulo.'</h4>',
            'id' => 'modalObraView' . $obra->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$obra->titulo.'</h4>',
            'id' => 'modalObraUpdate' . $obra->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

    <?php foreach ($autorModel as $autor) {

        Modal::begin([
            'header' => '<h4>'.$autor->primeiroNome.' '.$autor->segundoNome.' '.$autor->apelido.'</h4>',
            'id' => 'modalAutorView' . $autor->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$autor->primeiroNome.' '.$autor->segundoNome.' '.$autor->apelido.'</h4>',
            'id' => 'modalAutorUpdate' . $autor->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

    <?php foreach ($colecaoModel as $colecao) {

        Modal::begin([
            'header' => '<h4>'.$colecao->tituloColecao.'</h4>',
            'id' => 'modalColecaoView' . $colecao->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$colecao->tituloColecao.'</h4>',
            'id' => 'modalColecaoUpdate' . $colecao->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

</div>