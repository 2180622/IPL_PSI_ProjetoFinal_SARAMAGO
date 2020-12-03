<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Gestão da Equipa';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-equipa">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <hr>
</div>
<div>
    <h3 style="text-align: center">
        <p class="pull-left">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'equipa-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
        <---- Adicionar novo funcionário | Associar um utilizador ---->
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Associar', ['value'=>'equipa-associate', 'class' => 'btn btn-create','id'=>'modalButtonAssociate']) ?>
        </p>
    </h3>
</div>
<br>
<div>
    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar um Funcionário
            </div>
        ';

    }?>
    <br>

    <?php Pjax::begin(); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'headerOptions' => ['width' => '100'],
            ],
            [   'label'=>'Departamento',
                'attribute' => 'departamento',
                'headerOptions' => ['width' => '100']
            ],
            [   'label' => 'Leitor',
                'value' => function($funcionarios){
                            return $funcionarios->leitor->nome;},
            ],
            [   'label' => 'Email',
                'value' =>function($funcionarios){
                            return $funcionarios->leitor->user->email;},
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['equipa-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['equipa-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['equipa-delete','id'=>$id]),
                        ['data' => ['confirm' => 'Tem a certeza de que pretende apagar a '.$model->leitor->nome.'?', 'method'=>'post']
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
    $this->registerJs("
        $(function () {
            $('#modalButtonAssociate').click(function (){
                $('#modalAssociate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");

    foreach ($funcionarios as $funcionario){
        $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$funcionario->id."').click(function (){
                $('#modalView".$funcionario->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$funcionario->id."').click(function (){
                $('#modalUpdate".$funcionario->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }

    ?>

    <?php
    Modal::begin([

        'header' => '<h3>Novo Funcionário</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php
    Modal::begin([

        'header' => '<h3>Associar Funcionário</h3>',
        'id' => 'modalAssociate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($funcionarios as $funcionario){

        Modal::begin([
            'header' => '<h4>'.$funcionario->leitor->nome.'</h4>',
            'id' => 'modalView'.$funcionario->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$funcionario->leitor->nome.'</h4>',
            'id' => 'modalUpdate'.$funcionario->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>