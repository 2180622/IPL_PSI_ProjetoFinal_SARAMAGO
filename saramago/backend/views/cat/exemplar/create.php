<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */

$this->title = 'Criar Exemplar';
$this->params['breadcrumbs'][] = ['label' => 'Exemplares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar-create">


    <?= $this->render('_form', [
        'model' => $model, 'bibliotecaAll' => $bibliotecaAll, 'tipoexemplarAll' => $tipoexemplarAll, 'estatutoexemplarAll' => $estatutoexemplarAll,
    ]) ?>

</div>
