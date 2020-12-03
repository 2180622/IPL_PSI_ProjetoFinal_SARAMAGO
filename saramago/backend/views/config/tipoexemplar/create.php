<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoexemplar */

$this->title = 'Create Tipoexemplar';
$this->params['breadcrumbs'][] = ['label' => 'Tipoexemplars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoexemplar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
