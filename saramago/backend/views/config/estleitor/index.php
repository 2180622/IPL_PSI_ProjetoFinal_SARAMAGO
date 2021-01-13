<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Estatuto do Leitor';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-estleitor">

    <h1>
        <?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'estleitor-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>

    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info config" role="alert">
                <strong>Informação:</strong> Comece por registar os seus tipos de leitor.
            </div>
        ';
    }?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'estatuto',
                'label' => 'Estatuto'
            ],
            [
                'attribute' => 'tipo',
                'label' => 'Tipo',
                'filter' => ['aluno' => 'Aluno', 'docente' => 'Docente',
                    'funcionario' => 'Funcionário', 'externo' => 'Externo'],
                'value' => function ($model)
                {
                    if($model->tipo == 'aluno')
                    {return 'Aluno';}
                    elseif($model->tipo == 'docente')
                    {return 'Docente';}
                    elseif($model->tipo == 'funcionario')
                    {return 'Funcionário';}
                    elseif ($model->tipo == 'externo')
                    {return 'Externo';}
                }
            ],
            [
                'attribute' => 'nItens',
                'label' => 'Nº Itens',
                'headerOptions' => ['width' => '50px'],
            ],
            [
                'attribute' => 'prazoDias',
                'label' => 'Prazo (dias)',
                'headerOptions' => ['width' => '50px'],
            ],
            [
                'attribute' => 'registoOpac',
                'label' => 'Registo no OPAC?',
                'headerOptions' => ['width' => '50px'],
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                'filter' => ['0' => 'Não', '1' => 'Sim'],
            ],
            //'registoOpac',
            //'notas',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '140px'],
                'template' => '{view} {update} {delete}',
                'buttons' =>[
                    'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/estleitor-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/estleitor-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash')->size(FAS::SIZE_LG),
                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['config/estleitor-delete','id'=>$id]),
                        ['data' => ['confirm' => 'Tem a certeza de que pretende apagar o estatuto "'.$model->estatuto.'" do tipo "'.$model->tipo.'"?', 'method'=>'post']
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php

    foreach ($tipoleitorModel as $tipoleitor){
        $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$tipoleitor->id."').click(function (){
                $('#modalView".$tipoleitor->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$tipoleitor->id."').click(function (){
                $('#modalUpdate".$tipoleitor->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }
    ?>

    <?php Pjax::end(); ?>

    <?php
    $this->registerJs("
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

        'header' => '<h4>Novo Tipo de Leitor</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($tipoleitorModel as $tipoleitor){

        Modal::begin([
            'header' => '<h4>'.$tipoleitor->estatuto.'</h4>',
            'id' => 'modalView'.$tipoleitor->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$tipoleitor->estatuto.'</h4>',
            'id' => 'modalUpdate'.$tipoleitor->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>
</div>