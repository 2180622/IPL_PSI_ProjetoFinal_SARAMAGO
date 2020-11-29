<?php


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Logótipos';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-logotipos">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'info',
                'label'=> 'Tipo',
            ],
            [
                'attribute'=>'value',
                'label'=> 'Imagem',
                'format' => 'html',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'value' => function ($model){
                    if($model->value != null){
                        return '<h5><span class="label label-success">Definido</span></h5>';
                    }else{
                        return '<h5><span class="label label-danger">Não Definido</span></h5>';
                    }},
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url,$model,$id){
                        if ($model->value == null) {
                            return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                ['value' => Url::to(['logotipos-view', 'id' => $id]),
                                    'class' => 'btn btn-primary btn-sm','disabled' => 'disabled', 'id' => 'modalButtonView' . $id]);
                        }else{
                            return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                ['value' => Url::to(['logotipos-view', 'id' => $id]),
                                'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                        }
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['logotipos-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){
                         if ($model->value == null) {
                             return Html::button(FAS::icon('trash-restore')->size(FAS::SIZE_LG),
                                ['class' => 'btn btn-danger btn-sm inline', 'disabled' => 'disabled']);
                         }else{
                             return Html::a(Html::button(FAS::icon('trash-restore')->size(FAS::SIZE_LG),
                             ['class' => 'btn btn-danger btn-sm inline']), Url::to(['logotipos-reset','id'=>$id]),
                             ['data' => ['confirm' => 'Tem a certeza de que pretende repor o '.$model->info.'?', 'method'=>'post']
                             ]);
                         }
                    },
                ],
            ],
        ],
    ]); ?>

    <?php

    foreach ($logotiposModels as $logotiposModel){
        $this->registerJs("
    
        $(function () {
            $('#modalButtonView".$logotiposModel->id."').click(function (){
                $('#modalView".$logotiposModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$logotiposModel->id."').click(function (){
                $('#modalUpdate".$logotiposModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        ");
    }?>

    <?php Pjax::end(); ?>

    <?php foreach ($logotiposModels as $logotiposModel){

        Modal::begin([
            'header' => '<h4>'.$logotiposModel->info.'</h4>',
            'id' => 'modalView'.$logotiposModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$logotiposModel->info.'</h4>',
            'id' => 'modalUpdate'.$logotiposModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>
