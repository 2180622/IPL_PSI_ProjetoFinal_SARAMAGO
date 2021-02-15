<?php

use common\models\Curso;
use common\models\Tipoleitor;
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

    $listasTipoLeitor = ArrayHelper::map(Tipoleitor::find()->where(['tipo' => 'aluno'])->all(), 'id', 'estatuto', 'tipo',['enctype' => 'multipart/form-data']);

    $listasCursos = ArrayHelper::map(Curso::find()->select(["id, concat(nome, ' ', ' (',CodCurso,')') as Curso"])->asArray()->all(),
        'id', 'Curso',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_form']); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nif', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'pattern'=>'[0-9]{9}']) ?>

    <?= $form->field($model, 'docId', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataNasc', ['enableAjaxValidation' => true])->textInput()->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])?>

    <?= $form->field($model, 'morada', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidade', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codPostal', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'pattern'=>'[0-9]{4}|[0-9]{7}'])->hint('Formato: "1234" ou "1234567') ?>

    <?= $form->field($model, 'telemovel', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'pattern'=>'[0-9]{9}']) ?>

    <?= $form->field($model, 'telefone', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'pattern'=>'[0-9]{9}']) ?>

    <?= $form->field($model, 'email',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mail2',['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Biblioteca_id')->dropDownList($listasBiblioteca, ['prompt' => 'Selecione...'])->label('Biblioteca associada') ?>

    <?= $form->field($model, 'TipoLeitor_id')->dropDownList($listasTipoLeitor, ['prompt' => 'Selecione...'])->label('Tipo de Leitor') ?>

    <?= $form->field($model, 'numero', ['enableAjaxValidation' => true])->textInput(['maxlength' => true])->label('Número de Aluno'); ?>

    <?= $form->field($model, 'Curso_id')->dropDownList($listasCursos, ['prompt' => 'Nenhum'])->label('Curso'); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'guardar']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
