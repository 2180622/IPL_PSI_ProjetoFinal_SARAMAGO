<?php


/* @var $this yii\web\View */

use common\models\Config;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $model common\models\Config */

$this->title = 'Recibos';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index config-recibos">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <hr>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
            [   'label'=>'Definição',
                'attribute' => 'info',
                'headerOptions' => ['width' => '500']
            ],
            [
                'label' => 'Estado',
                'attribute' => 'value',
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '100',],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['recibos-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <?php
    foreach ($recibosModel as $reciboModel){
        $this->registerJs("
      
        $(function () {
            $('#modalButtonUpdate".$reciboModel->id."').click(function (){
                $('#modalUpdate".$reciboModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        ");
    }
    ?>

    <?php foreach ($recibosModel as $reciboModel){

        Modal::begin([
            'headerOptions' => ['teste' => 'modalHeader'],
            'header' => 'Definição',
            'id' => 'modalUpdate'.$reciboModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>


</div>