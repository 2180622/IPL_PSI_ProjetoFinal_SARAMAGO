<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reprografia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reprografia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dataPedido')->textInput() ?>

    <?= $form->field($model, 'dataConcluido')->textInput() ?>

    <?= $form->field($model, 'paginas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cor')->dropDownList([ 'Cores' => 'Cores', 'Preto e Branco' => 'Preto e Branco', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'copias')->textInput() ?>

    <?= $form->field($model, 'frenteVerso')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'aguarda' => 'Aguarda', 'processamento' => 'Processamento', 'levatamento' => 'Levatamento', 'concluido' => 'Concluido', 'cancelado' => 'Cancelado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'notaOpac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Leitor_id')->textInput() ?>

    <?= $form->field($model, 'Obra_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
