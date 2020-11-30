<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Biblioteca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biblioteca-form">

    <?php $form = ActiveForm::begin(['id' => 'biblioteca-form']); ?>

    <?= $form->field($model, 'codBiblioteca')->textInput(['maxlength' => true, 'style' => 'text-transform:uppercase'])->label('Código') ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Nome') ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Morada') ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Localidade') ?>

    <?= $form->field($model, 'codPostal')->textInput(['maxlength' => 7, 'pattern'=>'[0-9]{4}|[0-9]{7}'])->label("Código Postal")->hint('Formato: "1234" ou "1234567')?>

    <?= $form->field($model, 'levantamento')->dropdownList([1 => 'Sim', 2 =>'Não']);?>

    <?= $form->field($model, 'notasOpac')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => $model->id], 'preset' => 'basic']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>

