<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = 'Update Obra: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="obra-update">

    <?= $this->render('_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]) ?>

</div>
