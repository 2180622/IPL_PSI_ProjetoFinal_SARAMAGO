<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Autors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="autor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'primeiroNome',
            'segundoNome',
            'apelido',
            'tipo',
            'bibliografia:html',
            'dataNasc',
            'nacionalidade',
            'orcid',
        ],
    ]) ?>

</div>
