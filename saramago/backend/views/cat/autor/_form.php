<?php

use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;
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

    <?= $form->field($model, 'dataNasc')->textInput()->widget(DateTimePicker::className(),
            ['convertFormat' => true, 'type' => DateTimePicker::TYPE_INPUT, 'pluginOptions' => ['autoclose'=>true, 'format' => 'yyyy-M-dd']]);?>

    <?= $form->field($model, 'nacionalidade')->dropDownList(\backend\models\AutorForm::NACIONALIDADE) ?>

    <?= $form->field($model, 'orcid')->textInput(['maxlength' => true, 'pattern'=>'[0-9]{16}'])->hint("Open Researcher and Contributor ID <br>Formato: 0123456789012345") ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
