<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reserva de exemplar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar saramago-table fast-font">
    <div class="center-block" style="text-align: -webkit-center;">
        <?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova reserva de exemplar', [url::to('pesquisa/obra')], ['class' => 'button-saramago btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $reservaSearchModel,
        'columns' => [
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
            [   'label'=>'Cota do exemplar',
                'attribute'=>'Exemplar_id',
                'value'=>function($model){
                            return $model->exemplar->cota;},
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
            $('#modalView".$reservaExemplar->id."').modal('show')
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
