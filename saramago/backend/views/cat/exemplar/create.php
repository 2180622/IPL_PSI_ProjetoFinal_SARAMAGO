<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */

$this->title = 'Criar Exemplar';
$this->params['breadcrumbs'][] = ['label' => 'Exemplars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
