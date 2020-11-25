<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Irregularidades';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-irregularidades">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            [
                'attribute' => 'irregularidade',
                'label' => 'Tipo de obra',
            ],
            [
                'attribute' => 'diasAtivacao',
                'headerOptions' => ['width' => '300'],
            ],
            [
                'attribute' => 'diasBloqueio',
                'headerOptions' => ['width' => '300'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '50'],
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['irregularidades-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },

                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <?php
    foreach ($irregularidadesModels as $irregularidadeModel){
        $this->registerJs("
            
        $(function () {
            $('#modalButtonUpdate".$irregularidadeModel->id."').click(function (){
                $('#modalUpdate".$irregularidadeModel->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");
    }

    foreach ($irregularidadesModels as $irregularidadeModel){

        Modal::begin([
            'header' => '<h4>'.$irregularidadeModel->irregularidade.'</h4>',
            'id' => 'modalUpdate'.$irregularidadeModel->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>