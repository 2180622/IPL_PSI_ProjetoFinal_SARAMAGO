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
    $listasTipoLeitor = ArrayHelper::map($listaTiposLeitors,'id','estatuto',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_form']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password',['enableAjaxValidation' => true])->passwordInput() ?>

    <?= $form->field($model, 'nif')->textInput() ?>

    <?= $form->field($model, 'docId')->textInput() ?>

    <?= $form->field($model, 'dataNasc')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codPostal')->textInput() ?>

    <?= $form->field($model, 'telemovel')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput() ?>

    <?= $form->field($model, 'email',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail2',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Biblioteca_id')->dropDownList($listasBiblioteca)->label('Biblioteca associada') ?>

    <?= $form->field($model, 'TipoLeitor_id')->dropDownList($listasTipoLeitor)->label('Tipo de Leitor') ?>
    <div class="departamento" id="field-departamento">
    <?=  $form->field($model, 'departamento')->textInput()->label('Departamento') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        $this->registerJs("
            $(document).ready(function () {
                $(document).on('change', '#leitorform-tipoleitor_id', function () {
                    var val = $('#leitorform-tipoleitor_id').val();
                    console.log(val);
                    if( val == 1 ) {
                      $('#leitorform-departamento').hide();
                      $('#field-departamento').hide();
                    } else {
                      $('#leitorform-departamento').show();
                      $('#field-departamento').show();
                    }
                });
            });
        ");
    ?>

</div>
