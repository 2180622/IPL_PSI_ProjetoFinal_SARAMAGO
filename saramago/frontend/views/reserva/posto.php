<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reserva de postos de trabalho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto saramago-table fast-font">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova reserva de posto', ['posto-create'], ['class' => 'button-saramago btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $reservasPostoSearchModel,
        'columns' => [
            [   'label'=>'Data de reserva',
                'attribute' => 'dataReserva',
            ],
            [   'label'=>'Estado da reserva',
                'attribute'=>'estadoReserva',
            ],
            [   'label'=>'Lugar referente',
                'attribute'=>'lugar',
            ],
            [   'label'=>'Notas',
                'attribute' => 'notaOpac',
            ],
            [   'label'=>'Posto Reservado',
                'attribute'=>'PostoTrabalho_id',
                'value'=>function($reservasPosto){
                            return $reservasPosto->postoTrabalho->designacao;},
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url,$model,$id) {
                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['posto-delete', 'id' => $id]),
                            ['data' =>
                                ['confirm' => 'Tem a certeza de que pretende cancelar a reserva de posto?', 'method' => 'post']
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

    foreach ($reservasPosto as $reservaPosto){
    $this->registerJs("
    $(function () {
        $('#modalButtonView".$reservaPosto->id."').click(function (){
            $('#modalView".$reservaPosto->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });


    $(function () {
        $('#modalButtonUpdate".$reservaPosto->id."').click(function (){
            $('#modalUpdate".$reservaPosto->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });

    $(function () {
        $('#modalButtonDelete".$reservaPosto->id."').click(function (){
            $('#modalDelete".$reservaPosto->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });
    ");
    }

    Modal::begin([
    'header' => '<h3>Nova reserva de posto</h3>',
    'id' => 'modalCreate',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($reservasPosto as $reservaPosto){

        Modal::begin([
            'header' => '<h3>Leitor</h3>',
            'id' => 'modalView'.$reservaPosto->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'headerOptions' => ['id' => 'modalHeader'],
            'id' => 'modalUpdate'.$reservaPosto->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>
</div>
