<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->leitor->nome;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'nome',
            'label' => 'Nome',
            'value'=>function ($model){
                return $model->leitor->nome;},
        ],
        [
            'attribute' => 'username',
            'label' => 'Nome de Utilizador',
            'value'=>function ($model){
                return $model->leitor->user->username;},
        ],
        [
            'attribute' => 'codBarras',
            'label' => 'Cód. Barras',
            'value'=>function ($model){
                return $model->leitor->codBarras;},
        ],
        [
            'attribute' => 'nif',
            'label' => 'NIF',
            'value'=>function ($model){
                return $model->leitor->nif;},
        ],
        [
            'attribute' => 'docId',
            'label' => 'Doc Id',
            'value'=>function ($model){
                return $model->leitor->docId;},
        ],
        [
            'attribute' => 'dataNasc',
            'label' => 'Data de Nascimento',
            'value'=>function ($model){
                return $model->leitor->dataNasc;},
        ],
        [
            'attribute' => 'morada',
            'label' => 'Morada',
            'value'=>function ($model){
                return $model->leitor->morada;},
        ],
        [
            'attribute' => 'localidade',
            'label' => 'Localidade',
            'value'=>function ($model){
                return $model->leitor->localidade;},
        ],
        [
            'attribute' => 'codPostal',
            'label' => 'Código Postal',
            'value'=>function ($model){
                return $model->leitor->codPostal;},
        ],
        [
            'attribute' => 'telemovel',
            'label' => 'Telemóvel',
            'value'=>function ($model){
                return $model->leitor->telemovel;},
        ],
        [
            'attribute' => 'telefone',
            'label' => 'Telefone',
            'value'=>function ($model){
                return $model->leitor->telefone;},
        ],
        [
            'attribute' => 'email',
            'label' => 'Email',
            'value'=>function ($model){
                return $model->leitor->user->email;},
        ],
        [
            'attribute' => 'mail2',
            'label' => 'Email 2',
            'value'=>function ($model){
                return $model->leitor->mail2;},
        ],
        [
            'attribute' => 'notaInterna',
            'label' => 'Nota Interna',
            'value'=>function ($model){
                return $model->leitor->notaInterna;},
        ],
        [
            'attribute' => 'Biblioteca_id',
            'label' => 'Biblioteca',
            'value'=>function ($model){
                return $model->leitor->biblioteca->nome;},
        ],
        [
            'attribute' => 'TipoLeitor_id',
            'label' => 'Tipo de Leitor',
            'value'=>function ($model){
                return $model->leitor->tipoLeitor->tipo. ' - ' . $model->leitor->tipoLeitor->estatuto;},
        ],
    ],
]) ?>