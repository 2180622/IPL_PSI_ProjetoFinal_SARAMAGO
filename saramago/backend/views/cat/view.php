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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'imgCapa',
            [
                'label' => 'imgCapa',
                'attribute' => 'Capa',
                'format'=>['image',['width'=>'50%','display'=>'block', 'alt'=>$model->titulo]],
                'contentOptions'=>['style' => 'inline', 'width'=>'auto'],
                'value' => function($model){
                    if($model->imgCapa != null){return Url::toRoute('/img/'. $model->imgCapa);}}
            ],
            'titulo',
            'resumo:ntext',
            'editor',
            'ano',
            'tipoObra',
            'descricao',
            'local',
            'edicao',
            'assuntos',
            'preco',
            'dataRegisto',
            'dataAtualizado',
            'Cdu_id',
            'Colecao_id',
        ],
    ]) ?>

</div>
