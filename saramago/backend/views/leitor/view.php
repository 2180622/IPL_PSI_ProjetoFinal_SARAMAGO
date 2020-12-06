<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'codBarras',
        'nome',
        'nif',
        'docId',
        'dataNasc',
        'morada',
        'localidade',
        'codPostal',
        'telemovel',
        'telefone',
        [
            'label'=>'E-mail',
            'attribute'=>'user_id',
            'value' => function($leitores){
                return ''.$leitores->user->email;},
        ],
        'notaInterna',
        'dataRegisto',
        [
            'label'=> 'Biblioteca',
            'attribute'=>'Biblioteca_id',
            'value' => function($leitores){
                return ''. $leitores->biblioteca->codBiblioteca.' - '.$leitores->biblioteca->nome;}
        ],
        [
            'label'=> 'Tipo de Leitor',
            'attribute'=> 'TipoLeitor_id',
            'value' => function($leitores){
                return ''.$leitores->tipoLeitor->tipo;}
        ],
        [
            'label'=>'User',
            'attribute'=>'user_id',
            'value' => function($leitores){
                return ''.$leitores->user->username;},
        ],
    ],
]) ?>
