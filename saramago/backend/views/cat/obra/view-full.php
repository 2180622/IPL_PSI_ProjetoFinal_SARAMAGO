<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

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
                echo '<p> EAN: '.$model->materialavs->duracao.'</p>';
            }
            if($model->tipoObra == "monografia")
            {
                echo '<p>Tipo de Obra: Monografia</p>';
                echo '<p> Volume: '.$model->monografias->volume.'</p>';
                echo '<p> Páginas: '.$model->monografias->paginas.'</p>';
                echo '<p> ISBN: '.$model->materialavs->duracao.'</p>';
            }
            elseif($model->tipoObra == "pubPeriodica")
            {
                echo '<p>Tipo de Obra: Publicação Periódica</p>';
                echo '<p> Volume: '.$model->monografias->volume.'</p>';
                echo '<p> Série: '.$model->monografias->serie.'</p>';
                echo '<p> Número: '.$model->materialavs->duracao.'</p>';
                echo '<p> Número: '.$model->materialavs->ISNN.'</p>';
            }

            echo'<p>Ano: '.$model->ano.'</p><br>';
            echo'<p>Data Registado: '.Yii::$app->formatter->asDatetime($model->dataRegisto).'</p>';
            echo'<p>Data Atualizado: '.Yii::$app->formatter->asDatetime($model->dataAtualizado).'</p>';
            ?>
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('pencil-alt') . ' Editar Obra',
                ['value' => 'cat/obra-update?scenario='.$model->tipoObra, 'class' => 'btn btn-alt','id' => 'modalButtonUpdate']) ?>
            <?= Html::a(Html::button(FAS::icon('trash-alt').' Apagar obra', ['class' => 'btn btn-alt ']), Url::to(['delete', 'id' => $model->id]),
                ['data' =>
                    ['confirm' => 'Tem a certeza de que pretende apagar a obra ' . $model->titulo .' ('.$model->ano.')' . '?',
                        'method' => 'post']
                ]); ?>

            <?= Html::button(FAS::icon('plus') . ' Adicionar Exemplar',
                ['value' => 'exemplar-create', 'class' => 'btn btn-alt pull-right','id' => 'modalButtonCreate']) ?>
        </div>
        <div class="menu-table-saramago">
            <?php
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
                        //region Exemplares
                        [
                            'label' => 'Exemplares '. Html::tag('span', $model->getExemplars()->count(), ['class'=>'badge badge-light']),
                            'encode'=> false,
                            'active'=> true,
                            'content'=> GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'cota',
                                        'headerOptions' => ['width' => '200']
                                    ],
                                    [
                                        'label' => 'Cód. Barras',
                                        'attribute' => 'codBarras',
                                        'headerOptions' => ['width' => '200']
                                    ],
                                    [
                                        'label' => 'Tipo',
                                        'attribute' => 'TipoExemplar_id',
                                        'filter' => [ i
                                            'materialAv'=>'Material Audio-Visual',
                                            'monografia'=> 'Monografia',
                                            'pubPeriodica'=>'Publicação Periódica',
                                            'Tipo'=> $tipoExemplarAll[],
                                        ],
                                        'headerOptions' => ['width' => '200']
                                    ],
                                    [
                                        'label' => 'Estatuto',
                                        'attribute' => 'EstatutoExemplar_id',
                                        'filter' => [],
                                    ],
                                    [
                                        'label' => 'Suplemento?',
                                        'attribute' => 'suplemento',
                                        'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                                        'filter' => ['0' => 'Não', '1' => 'Sim'],
                                        'headerOptions' => ['width' => '100']
                                    ],
                                    [
                                        'label' => 'Estado',
                                        'attribute' => 'estado',
                                        'filter' => [
                                            'arrumacao' => 'Em Arrumação...',
                                            'estante'=>'Na Estante',
                                            'quarentena'=>'Quarentena',
                                            'perdido'=>'Perdido',
                                            'nd'=>'Não Disponível',
                                        ],
                                        'headerOptions' => ['width' => '100'],
                                        'value' => function ($model) {
                                            if($model->id){return ;}},
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'header' => 'Ações',
                                        'template' => '{view} {update} {delete}',
                                        'buttons' => [
                                            'view' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['exemplar-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                                            },
                                            'update' => function ($url, $model, $id) {
                                                return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                                    ['value' => Url::to(['exemplar-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                                            },
                                            'delete' => function ($url, $model, $id) {
                                                return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                                    ['class' => 'btn btn-danger btn-sm inline']), Url::to(['exemplar-delete', 'id' => $id]),
                                                    ['data' =>
                                                        ['confirm' => 'Tem a certeza de que pretende apagar o exemplar' . $model->cota . '?', 'method' => 'post']
                                                    ]);
                                            },
                                        ],
                                    ],
                                ],
                            ]),
                        ]
                        //endregion
                    ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>

        </div>
    </div>

<?php
    $this->registerJs("
        $(function () {
            $('#modalButtonObraUpdate').click(function (){
                $('#modalUpdate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        $(function () {
            $('#modalButtonCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");
?>

<?php
    Modal::begin([
        'header' => '<h3>Adicionar Exemplar</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    Modal::begin([
        'header' => '<h4>'.$model->titulo.'</h4>',
        'id' => 'modalObraUpdate' . $model->id,
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
?>

</div>
