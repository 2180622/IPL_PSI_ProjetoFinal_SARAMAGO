<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reprografia */

$this->title = 'Create Reprografia';
$this->params['breadcrumbs'][] = ['label' => 'Reprografias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reprografia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
