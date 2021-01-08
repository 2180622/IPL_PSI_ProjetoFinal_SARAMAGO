<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */

$this->title = $model->primeiroNome .' '. $model->segundoNome . ' ' . $model->apelido;
$this->params['breadcrumbs'][] = ['label' => 'Autores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="autor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'primeiroNome',
            'segundoNome',
            'apelido',
            'tipo',
            'bibliografia:ntext',
            'dataNasc',
            'nacionalidade',
            'orcid',
        ],
    ]) ?>

</div>
