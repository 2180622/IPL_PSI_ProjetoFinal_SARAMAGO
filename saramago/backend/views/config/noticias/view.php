<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Noticias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="noticias-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            [
                'label'=>'Conteúdo',
                'attribute'=>'conteudo',
                'format'=>'html',
            ],
        ],
    ]) ?>

</div>
