<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoLeitor */

$this->title = 'Update Tipo Leitor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Leitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-leitor-update">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>