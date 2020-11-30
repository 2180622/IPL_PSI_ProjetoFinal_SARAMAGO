<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model common\models\Biblioteca */
/* @var $searchModel app\models\BibliotecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->nome;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'codBiblioteca',
        'nome',
        'notasOpac:html',
        'morada',
        'localidade',
        [
            'attribute' => 'codPostal',
            'value'=>function ($model){
                if(strlen($model->codPostal) == 7 ){
                    return $cp1 = substr($model->codPostal, 0, 4).'-'.$cp2 = substr($model->codPostal, 4, 6);}
                else{return $model->codPostal;}
            }
        ],
        [
            'attribute' => 'levantamento',
            'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
            'filter' => ['0' => 'Não', '1' => 'Sim'],
        ],
    ],
]) ?>