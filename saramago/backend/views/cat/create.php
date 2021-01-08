<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = 'Criar Obra';
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obra-create">
    <?= $this->render('_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]) ?>
</div>
