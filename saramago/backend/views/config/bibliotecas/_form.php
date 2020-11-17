<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Biblioteca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biblioteca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codBiblioteca')->textInput(['maxlength' => true,
        'style' => 'text-transform:uppercase'])->label('Código') ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Nome') ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Morada') ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true, 'style' => 'text-transform:capitalize'])->label('Localidade') ?>

    <?= $form->field($model, 'codPostal')->textInput(['type'=>'number'])->label("Código Postal")?>

    <?= $form->field($model, 'levantamento')->dropdownList([1 => 'Sim', 2 =>'Não'], ['prompt'=>'Selecione a opção']);?>

    <?= $form->field($model, 'notasOpac')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end();?>

</div>

