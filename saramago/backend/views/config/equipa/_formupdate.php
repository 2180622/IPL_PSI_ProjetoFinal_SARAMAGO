<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="_formupdate">

    <?php

    $listasBiblioteca = ArrayHelper::map($listaBibliotecas,'id','nome',['enctype' => 'multipart/form-data']);
    $listasTipoLeitor = ArrayHelper::map($listaTiposLeitors,'id','tipo',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_formupdate']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->hint($leitor->nome) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->hint($user->username) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'nif')->textInput()->hint($leitor->nif) ?>

    <?= $form->field($model, 'docId')->textInput(['maxlength' => true])->hint($leitor->docId) ?>

    <?= $form->field($model, 'departamento')->textInput(['maxlength' => true])->hint($funcionario->departamento) ?>

    <?= $form->field($model, 'dataNasc')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])->hint($leitor->dataNasc)?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true])->hint($leitor->morada) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true])->hint($leitor->localidade) ?>

    <?= $form->field($model, 'codPostal')->textInput()->hint($leitor->codPostal) ?>

    <?= $form->field($model, 'telemovel')->textInput()->hint($leitor->telemovel) ?>

    <?= $form->field($model, 'telefone')->textInput()->hint($leitor->telefone) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint($user->email) ?>

    <?= $form->field($model, 'mail2')->textInput(['maxlength' => true])->hint($leitor->mail2) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true])->hint($leitor->notaInterna) ?>

    <?= $form->field($model, 'Biblioteca_id')->dropDownList($listasBiblioteca)->label('Biblioteca associada') ?>

    <?= $form->field($model, 'TipoLeitor_id')->dropDownList($listasTipoLeitor)->label('Tipo de Leitor') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>