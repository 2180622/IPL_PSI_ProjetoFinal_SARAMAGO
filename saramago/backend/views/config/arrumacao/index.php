<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $model common\models\Config */

$this->title = 'Arrumação';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-arrumacao">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <hr>

    <?php Yii::$app->session->getFlash('success');?>

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
                'header'=>'Ação',
                'headerOptions' => ['width' => '50px'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['arrumacao-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <?php
    foreach ($ArrumacaoModel as $arrumacao){
        $this->registerJs("
      
        $(function () {
            $('#modalButtonUpdate".$arrumacao->id."').click(function (){
                $('#modalUpdate".$arrumacao->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        ");
    }
    ?>

    <?php foreach ($ArrumacaoModel as $arrumacao){

        Modal::begin([
            'header' => '<h4>'.$arrumacao->info.'</h4>',
            'id' => 'modalUpdate'.$arrumacao->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>