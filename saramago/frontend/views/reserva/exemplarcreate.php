<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = 'Pedir nova reserva de exemplar';
$this->params['breadcrumbs'][] = ['label' => 'Reservas de exemplares', 'url' => ['exemplar']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('exemplar/_form', [
        'model' => $model,
    ]) ?>

</div>
