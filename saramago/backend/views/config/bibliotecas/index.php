<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BibliotecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $bibliotecasModels common\models\Biblioteca */

$this->title = 'Bibliotecas';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-bibliotecas">

    <h1>
        <?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'bibliotecas-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>

    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar as suas bibliotecas
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
                ['class' => 'yii\grid\SerialColumn'],
                [   'label'=>'Código',
                    'attribute' => 'codBiblioteca',
                    'headerOptions' => ['width' => '100']
                ],
                [   'label' => 'Biblioteca',
                    'attribute' => 'nome',
                ],
                [   'label' => 'Morada',
                    'attribute' =>'morada',
                ],
                [
                    'label' => 'Cód. Postal',
                    'attribute' => 'codPostal',
                    'value'=>function ($model){
                        if(strlen($model->codPostal) == 7 ){
                            return $cp1 = substr($model->codPostal, 0, 4).'-'.$cp2 = substr($model->codPostal, 4, 6);}
                        else{return $model->codPostal;}
                        },
                    'headerOptions' => ['width' => '100']
                ],
                [
                    'label' => 'Levantamento',
                    'attribute' => 'levantamento',
                    'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                    'filter' => ['0' => 'Não', '1' => 'Sim'],
                ],
                ['class' => 'yii\grid\ActionColumn',
                    'header'=>'Ações',
                    'headerOptions' => ['width' => '100'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                ['value'=>Url::to(['config/bibliotecas-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                        },
                        'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['config/bibliotecas-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                        },
                        'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['config/bibliotecas-delete','id'=>$id]),
                            ['data' => ['confirm' => 'Tem a certeza de que pretende apagar a '.$model->nome.'?', 'method'=>'post']
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

    foreach ($bibliotecasModels as $bibliotecasModel){
    $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$bibliotecasModel->id."').click(function (){
                $('#modalView".$bibliotecasModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$bibliotecasModel->id."').click(function (){
                $('#modalUpdate".$bibliotecasModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }

    ?>

    <?php
    Modal::begin([

        'header' => '<h4>Nova Biblioteca</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($bibliotecasModels as $bibliotecasModel){

        Modal::begin([
            'header' => '<h4>'.$bibliotecasModel->nome.'</h4>',
            'id' => 'modalView'.$bibliotecasModel->id,
            //'options' => ['class'=>'fade modal modalButtonView modal-v-'.$bibliotecasModel->id],
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$bibliotecasModel->nome.'</h4>',
            'id' => 'modalUpdate'.$bibliotecasModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>