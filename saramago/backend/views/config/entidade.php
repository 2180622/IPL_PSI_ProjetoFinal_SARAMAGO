<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entidade';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-entidade">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            [
                'attribute' => 'info',
                'label' => 'Entidade',
            ],
            [
                'attribute' => 'value',
                'label' => 'Valor',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ação',
                'headerOptions' => ['width' => '50'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['entidade-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                ],
            ],
        ],
    ]); 
    ?>

    <?php Pjax::end(); ?>
    <?php

    foreach ($entidadeModels as $entidadeModel){
    $this->registerJs("
        $(function () {
            $('#modalButtonUpdate".$entidadeModel->id."').click(function (){
                $('#modalUpdate".$entidadeModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
      
    ");
    }

    ?>

    <?php foreach ($entidadeModels as $entidadeModel){

        Modal::begin([
            'header' => '<h4>'.$entidadeModel->info.'</h4>',
            'id' => 'modalUpdate'.$entidadeModel->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>


</div>
