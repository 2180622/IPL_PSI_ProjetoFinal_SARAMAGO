<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postos-form">

    <?php
    $lista = ArrayHelper::map($listaBibliotecas,'id','nome',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'postos-form']); ?>

    <?= $form->field($model, 'designacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalLugares')->textInput() ?>

    <?= $form->field($model, 'notaOpac')->widget(CKEditor::className(), ['options' => ['rows' => 2, 'id' => $model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Biblioteca_id')->label('Biblioteca')->dropDownList($lista) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
