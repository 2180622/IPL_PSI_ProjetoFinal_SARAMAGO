<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reserva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataReserva')->textInput() ?>

    <?= $form->field($model, 'estadoReserva')->dropDownList([ 'reservado' => 'Reservado', 'cancelado' => 'Cancelado', 'concluido' => 'Concluido', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'dataFecho')->textInput() ?>

    <?= $form->field($model, 'notaReserva')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Leitor_id')->textInput() ?>

    <?= $form->field($model, 'Exemplar_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
