<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TipoLeitor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-leitor-form">

    <?php $form = ActiveForm::begin(['id'=>'tipo-leitor-form']); ?>

    <?= $form->field($model, 'estatuto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'Aluno' => 'Aluno', 'Docente' => 'Docente', 'Funcionário' => 'Funcionário', 'Externo' => 'Externo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nItens')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'prazoDias')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'registoOpac')->dropdownList([1 => 'Sim', 0 =>'Não']) ?>

    <?= $form->field($model, 'notas')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>