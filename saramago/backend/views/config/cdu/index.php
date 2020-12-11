<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Código Decimal Universal';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-cdu">

    <h1>
        <?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'cdu-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>

    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar os Códigos Decimais Universais.
            </div>
        ';
    }?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'codCdu',
                'label' => 'Código'
            ],
            'designacao:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['cdu-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['cdu-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url, $model, $id) {
                        return Html::a(Html::button(FAS::icon('trash')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['cdu-delete', 'id' => $id]),
                            ['data' => ['confirm' =>
                                "Tem a certeza de que pretende apagar: \n\n". $model->codCdu . ' - "'.$model->designacao .'" ?',
                                'method' => 'post']
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php
    foreach ($cduModel as $cdu)
    {
        $this->registerJs("
        $(function () {
            $('#modalButtonView".$cdu->id."').click(function (){
                $('#modalView".$cdu->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$cdu->id."').click(function (){
                $('#modalUpdate".$cdu->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
      
    ");
    }
    ?>

    <?php Pjax::end(); ?>

    <?php
    $this->registerJs(/** @lang JavaScript */"
        $(function () {
            $('#modalButtonCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
                var idHash = location.hash;
                var idRef = idHash.substring(1);
                $('#modalView'+idRef).modal('show')
                    .find('#modalContent')
                    .load('cdu-view?id='+idRef)
        });
    ");
    ?>

    <?php

    Modal::begin([
        'header' => '<h4>Novo Código</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    ?>

    <?php

    foreach ($cduModel as $cdu){

        Modal::begin([
            'header' => '<h4>'.$cdu->codCdu.' <small class="text-muted">'.$cdu->designacao.'</small></h4>',
            'id' => 'modalView'.$cdu->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    foreach ($cduModel as $cdu){

        Modal::begin([
            'header' => '<h4>'.$cdu->codCdu.' <small class="text-muted">'.$cdu->designacao.'</small></h4>',
            'id' => 'modalUpdate'.$cdu->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>