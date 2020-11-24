<?php

/* @var $this yii\web\View */
/* @var $model common\models\Biblioteca */

$this->title = 'Editar: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Bibliotecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="biblioteca-update">

    <?= $this->render('bibliotecas/_form', ['model' => $model,]) ?>

</div>

