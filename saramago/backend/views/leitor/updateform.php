<?php

use common\models\Curso;
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

    $listasTipoLeitor = ArrayHelper::map($listaTiposLeitors,'id',
        'estatuto','tipo', ['enctype' => 'multipart/form-data']);

    $listasCursos = ArrayHelper::map(Curso::find()->select(["id, concat(nome, ' ', ' (',CodCurso,')') as Curso"])->asArray()->all(),
        'id', 'Curso',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'updateform']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'nif')->textInput() ?>

    <?= $form->field($model, 'docId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataNasc')->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control'],])?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codPostal')->textInput() ?>

    <?= $form->field($model, 'telemovel')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Biblioteca_id')->dropDownList($listasBiblioteca)->label('Biblioteca associada') ?>

    <?= $form->field($model, 'TipoLeitor_id')->dropDownList($listasTipoLeitor, ['prompt' => 'Selecione...'])->label('Tipo de Leitor') ?>

    <div id="departamento" hidden>
        <?= $form->field($model, 'departamento')->textInput(['maxlength' => true])->label('Departamento'); ?>
    </div>
    <div id="aluno" hidden>
        <?= $form->field($model, 'numero')->textInput(['maxlength' => 11])->label('Número de Aluno'); ?>
        <?= $form->field($model, 'Curso_id')->dropDownList($listasCursos, ['prompt' => 'Nenhum'])->label('Curso'); ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $this->registerJs(/** @lang JavaScript */"
            $(document).ready(function () {
                $(document).on('change', '#leitorupdate-tipoleitor_id', function () {
                    var label = $('option:selected', this).closest('optgroup').attr('label');
                    console.log(label);
                    if( label == 'aluno' ) {
                        $('#aluno').show();
                        $('#departamento').hide();
                    }else if(label == 'docente' || label == 'funcionario') {
                        $('#departamento').show();
                        $('#aluno').hide();
                    }else if(label == 'externo'){
                        $('#departamento').hide();
                        $('#aluno').hide();
                    }else{
                        $('#departamento').hide();
                        $('#aluno').hide();                        
                    }
                });
            });
        ");
    ?>
</div>