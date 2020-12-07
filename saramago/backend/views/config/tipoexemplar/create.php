<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoexemplar */

$this->title = 'Create Tipo de Exemplar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoexemplar-create">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
