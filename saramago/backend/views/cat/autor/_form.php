<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Autor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autor-form">

    <?php $form = ActiveForm::begin(['id'=>'autor-form']); ?>

    <?= $form->field($model, 'primeiroNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segundoNome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apelido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'individual' => 'Individual', 'coletivo' => 'Coletivo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'bibliografia')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => $model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'dataNasc')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])?>

    <?= $form->field($model, 'nacionalidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orcid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
