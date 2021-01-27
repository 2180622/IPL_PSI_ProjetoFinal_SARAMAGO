<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas de exemplares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova reserva', ['exemplar-create'], ['class' => 'btn btn-create']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [   'label'=>'Data de reserva',
                'attribute' => 'dataReserva',
            ],
            [   'label'=>'Estado da reserva',
                'attribute'=>'estadoReserva',
            ],
            [   'label'=>'Data de fecho',
                'attribute'=>'dataFecho',
            ],
            [   'label'=>'Nota',
                'attribute'=>'notaReserva',
            ],
            [   'label'=>'Leitor Associado',
                'attribute'=>'Leitor_id',
                'value'=>function($reservaExemplar){
                            echo $reservaExemplar->leitor->nome;},
            ],
            [   'label'=>'Exemplar Reservado',
                'attribute'=>'Exemplar_id',
                'value'=>function($reservaExemplar){
                            echo $reservaExemplar->exemplar->cota;},
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){
                        //$btn_id='modalButtonView'.$id; return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        //      ['value'=>Url::to(['bibliotecas-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm modal-view-btn','id'=>$btn_id]);
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['exemplar-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['exemplar-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id) {
                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['exemplar-delete', 'id' => $id]),
                            ['data' =>
                                ['confirm' => 'Tem a certeza de que pretende fechar a reserva ?', 'method' => 'post']
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>

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

    foreach ($reservasExemplar as $reservaExemplar){
    $this->registerJs("
    $(function () {
        $('#modalButtonView".$reservaExemplar->id."').click(function (){
            $('#modalView".$reserva->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });


    $(function () {
        $('#modalButtonUpdate".$reservaExemplar->id."').click(function (){
            $('#modalUpdate".$reservaExemplar->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });

    $(function () {
        $('#modalButtonDelete".$reservaExemplar->id."').click(function (){
            $('#modalDelete".$reservaExemplar->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });
    ");
    }

    Modal::begin([
    'header' => '<h3>Nova Reserva</h3>',
    'id' => 'modalCreate',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($reservasExemplar as $reservaExemplar){

        Modal::begin([
            'header' => '<h3>Leitor</h3>',
            'id' => 'modalView'.$reservaExemplar->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modalUpdate'.$reservaExemplar->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>
</div>
