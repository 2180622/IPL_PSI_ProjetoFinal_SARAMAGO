<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ExemplarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="site-cat exemplar-index">

    <?php Pjax::begin();?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cota',
                'headerOptions' => ['width' => '200']
            ],
            [
                'label' => 'Cód. Barras',
                'attribute' => 'codBarras',
                'headerOptions' => ['width' => '200']
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'TipoExemplar_id',
                'filter' => [],
            ],
            [
                'label' => 'Estatuto',
                'attribute' => 'EstatutoExemplar_id',
                'filter' => [],
            ],
            [
                'label' => 'Suplemento?',
                'attribute' => 'suplemento',
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                'filter' => ['0' => 'Não', '1' => 'Sim'],
                'headerOptions' => ['width' => '100']
            ],
            [
                'label' => 'Estado',
                'attribute' => 'estado',
                'filter' => [
                    'arrumacao' => 'Em Arrumação...',
                    'estante'=>'Na Estante',
                    'quarentena'=>'Quarentena',
                    'perdido'=>'Perdido',
                    'nd'=>'Não Disponível',
                ],
                'headerOptions' => ['width' => '100']
            ],
            //'notaInterna',
            //'Biblioteca_id',

            //'Obra_id',
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $id) {
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value' => Url::to(['exemplar-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                    },
                    'update' => function ($url, $model, $id) {
                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value' => Url::to(['exemplar-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                    },
                    'delete' => function ($url, $model, $id) {
                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['exemplar-delete', 'id' => $id]),
                            ['data' =>
                                ['confirm' => 'Tem a certeza de que pretende apagar o exemplar' . $model->cota . '?', 'method' => 'post']
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>