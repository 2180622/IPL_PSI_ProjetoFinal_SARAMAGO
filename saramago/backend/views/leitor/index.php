<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Leitor */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Leitores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-leitor">
    <?php
    if($dataProvider->totalCount == 0){
        echo '<div class="alert alert-info config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Comece por registar os seus leitores.
              </div>';
    }
    ?>
    <div class="grid-container">
        <div class="menu-search-saramago">
            <?php Pjax::begin(); ?>
            <?= $this->render('_search', ['model' => $searchLeitor, 'id' => 'Refresh']) ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('plus') . ' Adicionar Leitor',
                ['value' => 'leitor/create', 'class' => 'btn btn-alt','id' => 'modalButtonCreate']) ?>
        </div>
        <div class="menu-table-saramago">

            <?php Pjax::begin(); ?>
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchLeitor,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Nome',
                        'attribute' => 'nome',
                        'format' => 'html',
                        'value' => function ($model) { return Html::a($model->nome, ['view-full', 'id' => $model->id]);}
                    ],
                    [
                        'label' => 'Doc. Id',
                        'attribute' => 'docId',
                        'headerOptions' => ['width' => '150'],
                    ],
                    [
                        'label' => 'Dta. Nascimento',
                        'attribute' => 'dataNasc',
                        'headerOptions' => ['width' => '100'],
                    ],
                    [
                        'label' => 'Tipo de Leitor',
                        'attribute' => 'TipoLeitor_id',
                        'headerOptions' => ['width' => '150'],
                        'filter' => [
                            'aluno'=>'Aluno',
                            'docente'=> 'Docente',
                            'funcionario'=>'Funcionário',
                            'externo'=>'Externo',
                            ],
                        'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                        'value' => function ($model) {
                            if($model->tipoLeitor->tipo == 'aluno'){ return 'Aluno';}
                            elseif($model->tipoLeitor->tipo == 'docente'){ return 'Docente';}
                            elseif($model->tipoLeitor->tipo == 'funcionario'){ return 'Funcionário';}
                            elseif($model->tipoLeitor->tipo == 'externo'){ return 'Externo';}
                        }
                    ],
                    [
                        'label' => 'E-mail',
                        'attribute' => 'user_id',
                        'value' => function ($leitores) { return '' . $leitores->user->email;
                        },
                    ],
                    [
                        'label' => 'Biblioteca',
                        'attribute' => 'Biblioteca_id',
                        'value' => function ($leitores) { return '' . $leitores->biblioteca->nome;
                        },
                    ],
                    ['label' => 'Cód Barras',
                        'attribute' => 'codBarras',
                        'headerOptions' => ['width' => '50'],
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Ações',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $id) {
                                return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                    ['value' => Url::to(['view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                            },
                            'update' => function ($url, $model, $id) {
                                return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                    ['value' => Url::to(['update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                            },
                            'delete' => function ($url, $model, $id) {
                                return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                    ['class' => 'btn btn-danger btn-sm inline']), Url::to(['delete', 'id' => $id]),
                                    ['data' =>
                                        ['confirm' => 'Tem a certeza de que pretende apagar o leitor ' . $model->nome . '?', 'method' => 'post']
                                    ]);
                            },
                        ],
                    ],
                ],
            ]); ?>

            <?php
            foreach ($leitores as $leitor) {
                $this->registerJs("
                    $(function () {
                    $('#modalButtonView" . $leitor->id . "').click(function (){
                        $('#modalView" . $leitor->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
    
                $(function () {
                    $('#modalButtonUpdate" . $leitor->id . "').click(function (){
                        $('#modalUpdate" . $leitor->id . "').modal('show')
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
    $this->registerJs("
        $(function () {
            $('#modalButtonCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            if(location.hash == '#create'){
                 $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load('leitor/create')
            }
        });
    ");
    ?>

    <?php
    Modal::begin([
        'header' => '<h3>Novo Leitor</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($leitores as $leitor) {

        Modal::begin([
            'header' => '<h4>'.$leitor->nome.'</h4>',
            'id' => 'modalView' . $leitor->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$leitor->nome.'</h4>',
            'id' => 'modalUpdate' . $leitor->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

</div>