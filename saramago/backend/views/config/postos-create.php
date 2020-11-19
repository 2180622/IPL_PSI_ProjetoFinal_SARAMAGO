<?php

/* @var $this yii\web\View */
/* @var $model common\models\Postotrabalho */

use yii\helpers\Html;

$this->title = 'Create Posto de Trabalho';
$this->params['breadcrumbs'][] = ['label' => 'Posto de Trabalho', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postotrabalho-create">
    <?= $this->render('postos/_form', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]) ?>
    
</div>
