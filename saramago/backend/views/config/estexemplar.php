<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Estatutos dos Exemplares';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-estexemplar">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'estatuto',
                'label' => 'Designação do Estatuto',
            ],
            [
                'attribute' => 'prazo',
                'label' => 'Prazo de Empréstimo (em dias)'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ação',
                'headerOptions' => ['width' => '100'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['estexemplar-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                ],
            ],
        ],
    ]);

    ?>

    <?php Pjax::end(); ?>

    <?php

    foreach ($estExemplarModels as $estExemplarModel)
    {
        $this->registerJs("
        $(function () {
            $('#modalButtonUpdate".$estExemplarModel->id."').click(function (){
                $('#modalUpdate".$estExemplarModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
      
    ");
    }

    ?>

    <?php foreach ($estExemplarModels as $estExemplarModels){

        Modal::begin([
            'header' => '<h4>'.$estExemplarModel->estatuto.'</h4>',
            'id' => 'modalUpdate'.$estExemplarModels->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>