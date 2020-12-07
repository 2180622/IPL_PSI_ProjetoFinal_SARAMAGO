<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exemplar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codBarras')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'suplemento')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'arrumacao' => 'Arrumacao', 'estante' => 'Estante', 'quarentena' => 'Quarentena', 'perdido' => 'Perdido', 'reservado' => 'Reservado', 'nd' => 'Nd', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Biblioteca_id')->textInput() ?>

    <?= $form->field($model, 'EstatutoExemplar_id')->textInput() ?>

    <?= $form->field($model, 'TipoExemplar_id')->textInput() ?>

    <?= $form->field($model, 'Obra_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
