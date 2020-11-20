<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Config */

$this->title = 'Editar entidade: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="entidade-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<?= $this->render('entidade/_form', ['model' => $model]) ?>

</div>
