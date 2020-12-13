<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Noticias */

$this->title = 'Create Noticias';
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticias-create">

    <?= $this->render('_form', ['model' => $model, 'identity' => $identity]) ?>

</div>
