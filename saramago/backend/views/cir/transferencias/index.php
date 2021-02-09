<?php

/* @var $this yii\web\View */

use common\models\Estatutoexemplar;
use common\models\Exemplar;
use common\models\Fundo;
use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;use yii\widgets\Pjax;

$this->title = 'Transferências';
$this->params['breadcrumbs'][] = ['label' => 'Circulação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-cir">
        <div class="alert alert-info config" role="alert" id="alert-saramago">
            <strong>Informação:</strong> Utilize o menu rápido para começar.
        </div>

<?php

Pjax::begin();

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cota',
                'headerOptions' => ['width' => '250']
            ],
            [
                'label' => 'Cód. Barras',
                'attribute' => 'codBarras',
                'headerOptions' => ['width' => '250']
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'TipoExemplar_id',
                'filter' => $tipoExemplarAll,
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'value' => function ($model)
                {
                    return $model->tipoExemplar->designacao;
                },
                'headerOptions' => ['width' => '200']

            ],
            [
                'label' => 'Estatuto',
                'attribute' => 'EstatutoExemplar_id',
                'value' => function ($model)
                {
                    return $model->estatutoExemplar->estatuto;
                },
                'filter' => Estatutoexemplar::EST_EXEMPLAR,
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'headerOptions' => ['width' => '150'],
            ],
            //FIXME FUNDO - Implementar o fundo_id
            [
                'label' => 'Fundo',
                'attribute' => 'Fundo_id',
                'filter'=> ArrayHelper::map(Fundo::find()->asArray()->all(), 'id', 'designacao'),
                'value' => function ($model)
                {
                    if($model->fundo != null){return $model->fundo->designacao;}
                },
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'headerOptions' => ['width' => '200'],
            ],
            [
                'label' => 'Suplemento?',
                'attribute' => 'suplemento',
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Ambos'],
                'filter' => ['0' => 'Não', '1' => 'Sim'],
                'headerOptions' => ['width' => '100']
            ],
            [
                'label' => 'Biblioteca',
                'attribute' => 'Biblioteca_id',
                'filter' => $bibliotecaAll,
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'headerOptions' => ['width' => '450'],
                'value' => function ($model)
                {
                    return $model->biblioteca->nome;
                }
            ],
            [
                'label' => 'Estado',
                'attribute' => 'estado',
                'format' => 'html',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'value' => function ($model)
                {
                    if($model->estado == 'arrumacao'){ return '<h4><span class="label label-info">Em Arrumação...</span></h4>';}
                    elseif($model->estado == 'estante'){return '<h4><span class="label label-success">Na Estante</span></h4>';}
                    elseif($model->estado == 'quarentena'){return '<h4><span class="label label-warning">Em Quarentena</span></h4>';}
                    elseif($model->estado == 'perdido'){return '<h4><span class="label label-danger">Perdido</span></h4>';}
                    elseif($model->estado == 'reservado'){return '<h4><span class="label label-info">Reservado</span></h4>';}
                    elseif($model->estado == 'emprestado'){return '<h4><span class="label label-info">Emprestado</span></h4>';}
                    elseif($model->estado == 'transferecia'){return '<h4><span class="label label-info">Transferência</span></h4>';}
                    elseif($model->estado == 'nd'){return '<h4><span class="label label-danger">Não Disponível</span></h4>';}
                },
                'filter' => Exemplar::ESTADO,
                'headerOptions' => ['width' => '100'],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'template' => '{view} {pedir} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $id) {
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value' => Url::to(['exemplar-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonExemplarView' . $id]);
                    },
                ],
            ],
        ],
    ]);

    Pjax::end();

?>
    </div>