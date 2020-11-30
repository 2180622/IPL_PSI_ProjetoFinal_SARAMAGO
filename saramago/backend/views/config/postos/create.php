<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Create Posto de Trabalho';
$this->params['breadcrumbs'][] = ['label' => 'Posto de Trabalho'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postotrabalho-create">
    <?= $this->render('_form', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]) ?>
</div>
