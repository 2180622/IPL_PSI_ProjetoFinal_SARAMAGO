<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservaspostoHojeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModelHoje app\models\ReservaspostoHojeSearch */
/* @var $dataProviderHoje yii\data\ActiveDataProvider */

?>
<div class="site-pto reservas">

    <?php Pjax::begin(); ?>

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Hoje '.Html::tag('span', $dataProviderHoje->count, ['class'=>'badge badge-light']),
                'encode'=> false,
                'options' => ['id' => 'tabHoje'],
                'content' => '<br>'.
                    GridView::widget([
                        'dataProvider' => $dataProviderHoje,
                        'filterModel' => $searchModelHoje,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            [   'attribute'=> 'lugar',
                                'label'=>'Lugar',
                                'headerOptions' => ['width' => '20'],
                                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                            ],
                            [   'attribute'=> 'Leitor_id',
                                'label'=>'Leitor',
                                'format' => 'html',
                                'value' => function ($model) { return Html::a($model->leitor->nome, ['leitor/view-full', 'id' => $model->Leitor_id]);}
                            ],
                            'dataPedido','dataReserva',
                            'notaInterna:html',
                            //'operador',
                            //'PostoTrabalho_id',
                            [
                                'attribute' => 'estadoReserva',
                                'label' => 'Estado',
                                'format' => 'html',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'filter' => [
                                    'reservado'=>'Reservado',
                                    'concluido'=> 'Concluído',
                                    'cancelado'=>'Cancelado',
                                    ],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'value' => function ($model)
                                    {
                                        if($model->estadoReserva == 'reservado'){
                                            return '<h5><span class="label label-success">Reservado</span></h5>';
                                        }elseif($model->estadoReserva == 'concluido'){
                                            return '<h5><span class="label label-info">Concluído</span></h5>';
                                        }elseif($model->estadoReserva == 'cancelado'){
                                            return '<h5><span class="label label-danger">Cancelado</span></h5>';
                                        }
                                    }
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Ações',
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonReservaView' . $id]);
                                    },
                                    'update' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonReservaUpdate' . $id]);
                                    },
                                    'delete' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('ellipsis-h')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-conf', 'id' => $id]), 'class' => 'btn btn-danger btn-sm', 'id' => 'modalButtonReservaConf' . $id]);
                                    },
                                ],
                            ],
                        ]
                    ]),
            ],
            [
                'label' => 'Todas '.Html::tag('span', $dataProvider->count, ['class'=>'badge badge-light']),
                'encode'=> false,
                'options' => ['id' => 'tabTodas'],
                'content'=> '<br>'.
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            [   'attribute'=> 'lugar',
                                'label'=>'Lugar',
                                'headerOptions' => ['width' => '20'],
                                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                            ],
                            [   'attribute'=> 'Leitor_id',
                                'label'=>'Leitor',
                                'format' => 'html',
                                'value' => function ($model) { return Html::a($model->leitor->nome, ['leitor/view-full', 'id' => $model->Leitor_id]);}
                            ],
                            'dataPedido',
                            'dataReserva',
                            'notaOpac:html',
                            'notaInterna:html',
                            //'operador',
                            //'PostoTrabalho_id',
                            [
                                'attribute' => 'estadoReserva',
                                'label' => 'Estado',
                                'format' => 'html',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'filter' => [
                                    'reservado'=>'Reservado',
                                    'concluido'=> 'Concluído',
                                    'cancelado'=>'Cancelado',
                                ],
                                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                'value' => function ($model)
                                {
                                    if($model->estadoReserva == 'reservado'){
                                        return '<h5><span class="label label-success">Reservado</span></h5>';
                                    }elseif($model->estadoReserva == 'concluido'){
                                        return '<h5><span class="label label-info">Concluído</span></h5>';
                                    }elseif($model->estadoReserva == 'cancelado'){
                                        return '<h5><span class="label label-danger">Cancelado</span></h5>';
                                    }
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Ações',
                                'template' => '{view} {update} {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonReservaView' . $id]);
                                    },
                                    'update' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonReservaUpdate' . $id]);
                                    },
                                    'delete' => function ($url, $model, $id) {
                                        return Html::button(FAS::icon('ellipsis-h')->size(FAS::SIZE_LG),
                                            ['value' => Url::to(['reserva-conf', 'id' => $id]), 'class' => 'btn btn-danger btn-sm', 'id' => 'modalButtonReservaConf' . $id]);
                                    },

                                ],
                            ],
                        ]]),
            ],
        ],
        'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
    ]);
    ?>

    <?php Pjax::end(); ?>

    <?php
    foreach ($reservas as $reserva){
        $this->registerJs("
            $(function () {
                $('#modalButtonReservaView" . $reserva->id . "').click(function (){
                $('#modalReservaView" . $reserva->id . "').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
                })
            });
    
            $(function () {
                $('#modalButtonReservaUpdate" . $reserva->id . "').click(function (){
                $('#modalReservaUpdate" . $reserva->id . "').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
                })
            });
            
            $(function () {
                $('#modalButtonReservaConf" . $reserva->id . "').click(function (){
                $('#modalReservaConf" . $reserva->id . "').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
                })
            });
        ");
    }
    ?>

</div>