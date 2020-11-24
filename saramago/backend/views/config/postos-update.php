<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Postotrabalho */

$this->title = 'Update Postotrabalho: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posto de Trabalho', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="postotrabalho-update">

    <!--<h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('postos/_form', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]) ?>

</div>