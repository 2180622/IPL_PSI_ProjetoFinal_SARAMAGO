<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ConsultaTReal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consulta-treal-update-form">

    <?php $form = ActiveForm::begin(); ?>

    <?// $form->field($model, 'dataHoraInicial')->textInput() ?>

    <?= $form->field($model, 'dataHoraFinal')->textInput() ?>

    <?= $form->field($model, 'operador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Leitor_id')->textInput() ?>

    <?= $form->field($model, 'Exemplar_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
