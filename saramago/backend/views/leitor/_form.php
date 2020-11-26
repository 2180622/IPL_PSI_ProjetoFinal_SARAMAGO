<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leitor-form">

    <?php

    $listasBiblioteca = ArrayHelper::map($listaBibliotecas,'id','nome',['enctype' => 'multipart/form-data']);
    $listasTipoLeitor = ArrayHelper::map($listaTiposLeitors,'id','tipo',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_form']); ?>

    <?= $form->field($modelSignUp, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'password')->passwordInput() ?>

    <?= $form->field($modelSignUp, 'nif')->textInput() ?>

    <?= $form->field($modelSignUp, 'docId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'dataNasc')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])?>

    <?= $form->field($modelSignUp, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'codPostal')->textInput() ?>

    <?= $form->field($modelSignUp, 'telemovel')->textInput() ?>

    <?= $form->field($modelSignUp, 'telefone')->textInput() ?>

    <?= $form->field($modelSignUp, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'mail2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelSignUp, 'Biblioteca_id')->dropDownList($listasBiblioteca)->label('Biblioteca associada') ?>

    <?= $form->field($modelSignUp, 'TipoLeitor_id')->dropDownList($listasTipoLeitor)->label('Tipo de Leitor') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
