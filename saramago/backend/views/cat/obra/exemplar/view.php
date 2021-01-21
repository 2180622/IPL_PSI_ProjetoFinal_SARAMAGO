<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exemplares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="exemplar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['exemplar-update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['exemplar-delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que quer apagar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cota',
            'codBarras',
            'suplemento',
            'estado',
            'notaInterna',
            'Biblioteca_id',
            'EstatutoExemplar_id',
            'TipoExemplar_id',
            'Obra_id',
        ],
    ]) ?>

</div>
