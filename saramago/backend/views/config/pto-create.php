<?php

/* @var $this yii\web\View */
/* @var $model common\models\Postotrabalho */

$this->title = 'Create Posto de Trabalho';
$this->params['breadcrumbs'][] = ['label' => 'Posto de Trabalho', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postotrabalho-create">
    <?= $this->render('pto/_form', ['model' => $model,]) ?>
</div>
