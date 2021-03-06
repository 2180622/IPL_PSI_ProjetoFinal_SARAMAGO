<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model' => $model,
    'options' => ['style' => 'height: 100%;'],
    'attributes' => [
        [
            'attribute'=>'',
            'value'=>'Nome do autor: '.$model->primeiroNome.' '.$model->segundoNome. ' ' . $model->apelido,
        ],
        [
            'attribute'=>'',
            'value'=>'Tipo de autor: '.$model->tipo,
        ],
        [
            'attribute'=>'',
            'value'=>'Bibliografia: '.$model->bibliografia,
            'format'=>'html',
        ],
        [
            'attribute'=>'',
            'value'=>'Data de nascimento: '.$model->dataNasc,
        ],
        [
            'attribute'=>'',
            'value'=>'Nacionalidade: '.$model->nacionalidade,
        ],
        [
            'attribute'=>'',
            'value'=>'Open Researcher and Contributor ID: '.$model->orcid,
        ],
        [
        'attribute'=>'',
            'value'=>'Número de obras publicadas: '.$model->getObras()->count(),
        ],
    ],
]) ?>