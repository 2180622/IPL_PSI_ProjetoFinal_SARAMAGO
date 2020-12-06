<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Tipos de exemplar';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-tipoexemplar">

    <h1><?= Html::encode($this->title) ?>
    	<p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'bibliotecas-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>

    <hr>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'designacao',
                'label' => 'Designação do tipo de exemplar',
            ],
            [
                'attribute' => 'tipo',
                'label' => 'Grupo característico do tipo de exemplar'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ação',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                        'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                ['value'=>Url::to(['config/tipoexemplar-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                        },
                        'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['config/tipoexemplar-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                        },
                        'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['config/tipoexemplar-delete','id'=>$id]),
                            ['data' => ['confirm' => 'Tem a certeza de que pretende apagar a '.$model->designacao.'?', 'method'=>'post']
                            ]);
                        },
                    ],

            ],
        ],
    ]);

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

    foreach ($tipoexemplarModels as $tipoexemplarModel){
    $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$tipoexemplarModel->id."').click(function (){
                $('#modalView".$tipoexemplarModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$tipoexemplarModel->id."').click(function (){
                $('#modalUpdate".$tipoexemplarModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }

    ?>

    <?php
    Modal::begin([

        'header' => '<h4>Novo Tipo de Exemplar</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($tipoexemplarModels as $tipoexemplarModel){

        Modal::begin([
            'header' => '<h4>'.$tipoexemplarModel->designacao.'</h4>',
            'id' => 'modalView'.$tipoexemplarModel->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$tipoexemplarModel->designacao.'</h4>',
            'id' => 'modalUpdate'.$tipoexemplarModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>