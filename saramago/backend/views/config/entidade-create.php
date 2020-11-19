<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Config */

$this->title = 'Criar entidade';
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
