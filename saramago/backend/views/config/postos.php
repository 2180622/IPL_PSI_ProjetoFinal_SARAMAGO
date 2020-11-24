<?php

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Postos de Trabalho';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-postos">

    <h1><?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'postos-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>
    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar os Postos de Trabalho da sua entidade.
            </div>
        ';

    }?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [   'label'=>'Designação',
                'attribute'=> 'designacao'],
            [   'label'=>'Número de Lugares',
                'attribute'=>'totalLugares'],
            [   'label'=>'Informação para OPAC',
                'attribute'=>'notaOpac'],
            [   'label'=> 'Informação Interna',
                'attribute'=>'notaInterna'],
            [   'label'=>'Biblioteca',
                'attribute'=>'Biblioteca_id'],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['postos-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['postos-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['postos-delete','id'=>$id]), 'class' => 'btn btn-danger btn-sm','id'=>'modalButtonDelete'.$id]);
                                //'data' => [
                                    //'confirm' => 'Tem a certeza de que pretende apagar a '.$model->designacao.'?',
                                  //  'method' => 'post']]);
                    },
                ],
            ],
        ],
    ]);

    $this->registerJs("
    $(function () {
        $('#modalButtonCreate').click(function (){
            $('#modalCreate').modal('show').find('#modalContent').load($(this).attr('value'))
        })
    });");

    foreach ($postoTrabalhoModels as $postoTrabalhoModel){
    $this->registerJs("
    $(function () {
        $('#modalButtonView".$postoTrabalhoModel->id."').click(function (){
            $('#modalView".$postoTrabalhoModel->id."').modal('show').find('#modalContent').load($(this).attr('value'))
        })
    });

    $(function () {
        $('#modalButtonUpdate".$postoTrabalhoModel->id."').click(function (){
            $('#modalUpdate".$postoTrabalhoModel->id."').modal('show').find('#modalContent').load($(this).attr('value'))
        })
    });

    $(function () {
        $('#modalButtonDelete".$postoTrabalhoModel->id."').click(function (){
            $('#modalDelete".$postoTrabalhoModel->id."').modal('show').find('#modalContent').load($(this).attr('value'))
        })
    });");
    }
    ?>

    <?php Pjax::end(); ?>
    <?php
    Modal::begin([

        'header' => '<h3>Novo Posto de Trabalho</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($postoTrabalhoModels as $postoTrabalhoModel){

        Modal::begin([
            'header' => '<h3>Posto de Trabalho</h3>',
            'id' => 'modalView'.$postoTrabalhoModel->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h3>Editar Posto de Trabalho',
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modalUpdate'.$postoTrabalhoModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h3>Eliminar Posto de Trabalho',
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modalDelete'.$postoTrabalhoModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>


</div>
