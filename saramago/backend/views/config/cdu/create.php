<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cdu */

$this->title = 'Create Cdu';
$this->params['breadcrumbs'][] = ['label' => 'Cdus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cdu-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>
