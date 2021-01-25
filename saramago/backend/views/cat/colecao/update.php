<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Colecao */

$this->title = 'Update Colecao: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colecaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="colecao-update">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
