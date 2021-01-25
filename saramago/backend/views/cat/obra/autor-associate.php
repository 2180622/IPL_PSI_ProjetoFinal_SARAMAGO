<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ObraAutor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obra-autor-form">

    <?php $form = ActiveForm::begin(['id' => 'autor-associate']); ?>

    <?= $form->field($model, 'Obra_id')->hiddenInput(['value'=> $idObra])->label(false)?>

    <?= $form->field($model, 'Autor_id', ['enableAjaxValidation' => true])->dropDownList($autorAll, ['prompt' => 'Selecione...'])->label('Autor') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>