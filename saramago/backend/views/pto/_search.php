<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReservaspostoHojeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reservasposto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dataPedido') ?>

    <?= $form->field($model, 'dataReserva') ?>

    <?= $form->field($model, 'lugar') ?>

    <?= $form->field($model, 'notaOpac') ?>

    <?php // echo $form->field($model, 'notaInterna') ?>

    <?php // echo $form->field($model, 'estadoReserva') ?>

    <?php // echo $form->field($model, 'operador') ?>

    <?php // echo $form->field($model, 'Leitor_id') ?>

    <?php // echo $form->field($model, 'PostoTrabalho_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
