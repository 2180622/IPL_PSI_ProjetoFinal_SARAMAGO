<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notícias';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-noticias">

    <h1>
        <?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'noticias-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>
    <hr>
    <?php
    if($dataProvider->totalCount == 0)
    {
        echo '
            <div class="alert alert-info config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Comece por registar conteúdos relevantes para os seus leitores ou a sua equipa.
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
                'label'=>'Assunto',
                'attribute'=>'assunto',
            ],
            [
                'label'=>'Data Visível',
                'attribute'=>'dataVisivel',
                'format'=>'date',
            ],
            [
                'label'=>'Data de Expiração',
                'attribute'=>'dataExpiracao',
                'format'=>'date',
            ],
            'autor',
            [
                'label'=>'Interface',
                'attribute'=>'interface',
            ],
            [
                'label'=>'Criado',
                'attribute'=>'dataRegisto',
            ],
            //'conteudo:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Ações',
                'headerOptions' => ['width' => '140px'],
                'template' => '{view} {update} {delete}',
                'buttons' =>[
                    'view' => function ($url,$model,$id){return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/noticias-view','id'=>$id]), 'class' => 'btn btn-primary btn-sm','id'=>'modalButtonView'.$id]);
                    },
                    'update' => function ($url,$model,$id){return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                        ['value'=>Url::to(['config/noticias-update','id'=>$id]), 'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUpdate'.$id]);
                    },
                    'delete' => function ($url,$model,$id){return Html::a(Html::button(FAS::icon('trash')->size(FAS::SIZE_LG),
                        ['class' => 'btn btn-danger btn-sm inline']), Url::to(['config/noticias-delete','id'=>$id]),
                        ['data' => ['confirm' => "Tem a certeza de que pretende apagar a notícia: \n".'Assunto: "'. $model->assunto.'" ?', 'method'=>'post']
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php
    foreach ($noticiasModel as $noticia)
    {
        $this->registerJs("
        $(function () {
            $('#modalButtonView".$noticia->id."').click(function (){
                $('#modalView".$noticia->id."').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonUpdate".$noticia->id."').click(function (){
                $('#modalUpdate".$noticia->id."').modal('show')
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
                    .load('noticias-view?id='+idRef)
        });
    ");
    ?>

    <?php

    Modal::begin([
        'header' => '<h4>Nova Notícia</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    ?>

    <?php

    foreach ($noticiasModel as $noticias){

        Modal::begin([
            'header' => '<h4>'.$noticias->assunto.'</h4>',
            'id' => 'modalView'.$noticias->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    foreach ($noticiasModel as $cdu){

        Modal::begin([
            'header' => '<h4>'.$noticias->assunto.'</h4>',
            'id' => 'modalUpdate'.$noticias->id,
            'size' => 'modal-md',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }

    ?>

</div>
