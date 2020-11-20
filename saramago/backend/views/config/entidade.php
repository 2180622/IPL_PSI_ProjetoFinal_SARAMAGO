<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entidade';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entidade-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'entidade-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'info',
            'key',
            'value',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['entidade-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['entidade-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['entidade-delete','id'=>$id]), 'class' => 'btn btn-danger btn-sm','id'=>'modalButtonDelete'.$id]);
                                //'data' => [
                                    //'confirm' => 'Tem a certeza de que pretende apagar a '.$model->designacao.'?',
                                  //  'method' => 'post']]);
                    },
                ],
            ],
        ],
    ]); 
    ?>
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

    foreach ($entidadeModels as $entidadeModel){
    $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$entidadeModel->id."').click(function (){
                $('#modalView".$entidadeModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        
        $(function () {
            $('#modalButtonUpdate".$entidadeModel->id."').click(function (){
                $('#modalUpdate".$entidadeModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonDelete".$entidadeModel->id."').click(function (){
                $('#modalDelete".$entidadeModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");
    }

    ?>

    <?php Pjax::end(); ?>

    <?php
    Modal::begin([

        'header' => '<h3>Nova Entidade</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($entidadeModels as $entidadeModel){

        Modal::begin([
            'header' => '<h3>Entidade</h3>',
            'id' => 'modalView'.$entidadeModel->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modalUpdate'.$entidadeModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>


</div>
