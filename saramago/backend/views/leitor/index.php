<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Leitores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="width: 100%">
    <div class="row">
        <p class="pull-right" style="width: 100%;">
            <?= Html::button(FAS::icon('plus').' Adicionar Leitor', ['value'=>'leitor/create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
        <div class="col-md-10" style="border-style: solid; border-radius: 10px;border-width: 1px">
            <div class="col-md-12">
                <div>
                    <p>Procurar por primeiro nome:</p>
                </div>
                <?php Pjax::begin(); ?>

                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchLeitor,
                    'columns' => [
                        [   'label'=>'Cód Barras',
                            'attribute' => 'codBarras',
                            'headerOptions' => ['width' => '50'],
                        ],
                        [   'label' => 'Nome',
                            'attribute' => 'nome',
                        ],
                        [   'label' => 'Doc Id',
                            'attribute' =>'docId',
                        ],
                        [
                            'label' => 'Data de Nascimento',
                            'attribute' => 'dataNasc',
                            'headerOptions' => ['width' => '100'],
                        ],
                        [
                            'label' => 'Tipo de Leitor',
                            'attribute' => 'TipoLeitor_id',
                            'value' => function($leitores){
                                return ''.$leitores->tipoLeitor->tipo;},
                        ],
                        [
                            'label' => 'Biblioteca',
                            'attribute' => 'Biblioteca_id',
                            'value' => function($leitores){
                                return ''.$leitores->biblioteca->nome;},
                        ],
                        [
                            'label' => 'E-mail',
                            'attribute' => 'user_id',
                            'value' => function($leitores){
                                return ''.$leitores->user->email;},
                        ],
                        ['class' => 'yii\grid\ActionColumn',
                            'header'=>'Ações',
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function ($url,$model,$id){
                                    //$btn_id='modalButtonView'.$id; return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                    //      ['value'=>Url::to(['bibliotecas-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm modal-view-btn','id'=>$btn_id]);
                                    return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                        ['value'=>Url::to(['view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                                },
                                'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                    ['value'=>Url::to(['update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                                },
                                'delete' => function ($url,$model,$id) {
                                    return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['delete', 'id' => $id]),
                                        ['data' =>
                                            ['confirm' => 'Tem a certeza de que pretende apagar o leitor ' . $model->nome . '?', 'method' => 'post']
                                        ]);
                                },
                            ],
                        ],
                    ],
                ]);?>
       <?php Pjax::end();?>
                    </div>
                </div>
                    <div class="col-md-2" style="border-style: solid; border-radius: 10px;border-width: 1px;">
                        <div class="col-md-12">
                            <p>Filtros</p>
                            <div>
                                <p>CENAS AQUI DENTRO</p>
                                <p>CENAS AQUI DENTRO</p>
                                <p>CENAS AQUI DENTRO</p>
                                <p>CENAS AQUI DENTRO</p>
                                <p>CENAS AQUI DENTRO</p>
                            </div>
                        </div>
                    </div> <?php


$this->registerJs("
    $(function () {
        $('#modalButtonCreate').click(function (){
            $('#modalCreate').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });
");

foreach ($leitores as $leitore){
    $this->registerJs("
        $(function () {
            $('#modalButtonView".$leitore->id."').click(function (){
                $('#modalView".$leitore->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    
    
    $(function () {
        $('#modalButtonUpdate".$leitore->id."').click(function (){
            $('#modalUpdate".$leitore->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
        })
    });
        
    $(function () {
        $('#modalButtonDelete".$leitore->id."').click(function (){
            $('#modalDelete".$leitore->id."').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'))
            })
        });
    ");
}

Modal::begin([
    'header' => '<h3>Novo Leitor</h3>',
    'id' => 'modalCreate',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static']
]);
echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
Modal::end();
?>

<?php foreach ($leitores as $leitore){

    Modal::begin([
        'header' => '<h3>Leitor</h3>',
        'id' => 'modalView'.$leitore->id,
        //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modalUpdate'.$leitore->id,
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
}

?>
    </div>
</div>

