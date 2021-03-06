<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Leitor */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\ButtonDropdown;
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
    if($bibliotecasCount == 0){
        echo '
                <div class="alert alert-warning config" role="alert">
                    <strong>Informação:</strong> Para usar este módulo tem que: <br>
                     - Adicionar, pelo menos, uma <b>biblioteca</b>, em "Administração / Bibliotecas / Adicionar" ou '.Html::a( 'clicando aqui',['config/bibliotecas#create']).'.<br>
                </div>
            ';
    }elseif($tiposLeitoresCount == 0){
        echo '
                <div class="alert alert-warning config" role="alert">
                    <strong>Informação:</strong> Para usar este módulo tem que: <br>
                     - Adicionar, pelo menos, um <b>tipo de leitor</b>, em "Administração / Estatuto do Leitor / Adicionar" ou '.Html::a( 'clicando aqui',['config/estleitor#create']).'.<br>
                </div>
            ';
    }else{
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
                <?= ButtonDropdown::widget([
                        'label' => FAS::icon('user') . ' Adicionar Leitores',
                    'encodeLabel' => false,
                    'options' => ['class' => 'btn btn-alt dropdown-toggle'],
                    'dropdown' => [
                        'encodeLabels' => false,
                        'options' => ['class' => 'dropdown-menu-right'],
                        'items' => [
                            [
                                'label' => FAS::icon('plus') . ' Adicionar Aluno',
                                'options' => ['value' => 'leitor/create?scenario=aluno', 'class' => 'btn btn-secondary',
                                    'id' => 'modalButtonAlunoCreate']
                            ],
                            [
                                'label' => FAS::icon('plus') . ' Adicionar Docente/Funcionario',
                                'options' => ['value' => 'leitor/create?scenario=docente', 'class' => 'btn btn-secondary',
                                    'id' => 'modalButtonDocenteCreate']
                            ],
                            [
                                'label' => FAS::icon('plus') . ' Adicionar Externo',
                                'options' => ['value' => 'leitor/create?scenario=externo', 'class' => 'btn btn-secondary',
                                    'id' => 'modalButtonExternoCreate']
                            ],
                        ],
                    ],
                ]); ?>
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
                            'filter' => $bibliotecaAll,
                            'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                            'value' => function ($leitores) { return '' . $leitores->biblioteca->nome;
                            },
                        ],
                        ['label' => 'Cód Barras',
                            'attribute' => 'codBarras',
                            'headerOptions' => ['width' => '50'],
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'header' => 'Ações',
                            'template' => '{view} {update}',
                            'buttons' => [
                                'view' => function ($url, $model, $id) {
                                    return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                        ['value' => Url::to(['view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                                    },
                                'update' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                                    },
                                ],
                            ],
                        ],
                    ]);
                //}
    ?>

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
    <?php Pjax::end(); }?>
        </div>
    </div>
    <br>

    <?php
    $this->registerJs("
        $(function () {
            $('#modalButtonAlunoCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'));  
            })
        });
        
        $(function () {
            $('#modalButtonDocenteCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'));
            })
        });
        
        $(function () {
            $('#modalButtonExternoCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent').load($(this).attr('value'))
            })
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