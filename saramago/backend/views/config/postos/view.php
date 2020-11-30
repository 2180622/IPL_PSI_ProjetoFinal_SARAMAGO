<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $searchModel app\models\BibliotecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->designacao;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'designacao',
        'totalLugares',
        'notaOpac:html',
        'notaInterna',
        [
            'attribute' => 'Biblioteca_id',
            'label' => 'Biblioteca',
            'value'=>function ($model){
                return $model->biblioteca->codBiblioteca.' - '.$model->biblioteca->nome;},
            'filter' => ['0' => 'Não', '1' => 'Sim'],
        ],
    ],
]) ?>
