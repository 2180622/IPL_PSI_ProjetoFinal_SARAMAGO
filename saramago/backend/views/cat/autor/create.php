<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */

$this->title = 'Criar Autor';
$this->params['breadcrumbs'][] = ['label' => 'Autores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autor-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
