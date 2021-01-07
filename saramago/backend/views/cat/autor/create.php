<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */

$this->title = 'Create Autor';
$this->params['breadcrumbs'][] = ['label' => 'Autors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="autor-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
