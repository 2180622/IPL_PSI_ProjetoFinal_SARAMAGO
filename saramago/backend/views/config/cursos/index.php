<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Cursos';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-cursos">

    <h1>
        <?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'cursos-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>

    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar os seus cursos
            </div>
        ';
    }?>

    <div class="row container">

        <!--<div class="col-md-6">-->

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'CodCurso',
                'label' =>'Cód. Curso',
                'headerOptions' => ['width' => '100'],
            ],
            [
                'attribute' => 'nome',
                'label' =>'Designação',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '150px'],
                'header'=>'Ações',
                'buttons' =>[
                    'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/cursos-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/cursos-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['config/cursos-delete','id'=>$id]),
                        ['data' => ['confirm' => 'Tem a certeza de que pretende apagar o curso '.$model->nome.'?', 'method'=>'post']
                        ]);
                    },
                ],
            ],
        ],
        'options' => ['style'=>'']
    ]); ?>

    <?php

    foreach ($cursosModels as $cursoModel){
        $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$cursoModel->id."').click(function (){
                $('#modalView".$cursoModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$cursoModel->id."').click(function (){
                $('#modalUpdate".$cursoModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }
    ?>
    <?php Pjax::end(); ?>
        </div>

        <!--<div class="col-md-6">-->

        </div>

    </div>

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

        'header' => '<h4>Novo Curso</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($cursosModels as $cursoModel){

        Modal::begin([
            'header' => '<h4>'.$cursoModel->nome.'</h4>',
            'id' => 'modalView'.$cursoModel->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$cursoModel->nome.'</h4>',
            'id' => 'modalUpdate'.$cursoModel->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>