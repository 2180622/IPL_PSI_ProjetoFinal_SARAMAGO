<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="obra-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nº do Sistema',
                'attribute' => 'id',
            ],
            [
                'label' => 'Capa',
                'attribute' => 'imgCapa',
                'format'=>['image',['width'=>'50%','display'=>'block', 'alt'=>$model->titulo]],
                'contentOptions'=>['style' => 'inline', 'width'=>'auto'],
                'value' => function($model){
                    if($model->imgCapa != null){return Url::toRoute('/img/'. $model->imgCapa);}}
            ],
            [
                'label' => 'Caminho',
                'attribute' => 'imgCapa',
            ],
            'titulo',
            'resumo:html',
            'editor',
            'ano',
            [
                'label'=>'Tipo de Obra',
                'attribute'=>'tipoObra',
                'value' => function ($model) {
                    if($model->tipoObra == 'materialAv'){ return 'Material Audio-Visual';}
                    elseif ($model->tipoObra == 'monografia'){return 'Monografia';}
                    elseif ($model->tipoObra == 'pubPeriodica'){return 'Publicação Periódica';}
                }
            ],
            [
                'label'=>'Descrição',
                'attribute'=>'descricao'
            ],
            'local',
            'edicao',
            'assuntos',
            'preco',
            [
                'label'=>'Data Registo',
                'attribute'=>'dataRegisto',
                'value'=> function ($model) {return Yii::$app->formatter->asDatetime($model->dataRegisto);}
            ],[
                'label'=>'Data Atualizado',
                'attribute'=>'dataAtualizado',
                'value'=> function ($model) {return Yii::$app->formatter->asDatetime($model->dataAtualizado);}
            ],
            [
                'label'=>'Classificação Decimal Universal',
                'attribute'=>'Cdu_id',
                'value' => function ($model) { return $model->cdu->codCdu.' ('. $model->cdu->designacao.')';}
            ],
            [
                'label'=>'Coleção',
                'attribute'=>'Colecao_id',
                'value' => function ($model) {
                    if($model->colecao != null) {return $model->colecao->tituloColecao;}}
            ],
        ],
    ]) ?>

</div>
