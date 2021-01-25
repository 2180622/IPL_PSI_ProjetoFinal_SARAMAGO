<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Colecao */

$this->title = 'Create Colecao';
$this->params['breadcrumbs'][] = ['label' => 'Colecaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colecao-create">

    <?= $this->render('_form', ['model' => $model,]) ?>

</div>
