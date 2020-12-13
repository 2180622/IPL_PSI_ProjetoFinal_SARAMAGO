<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Noticias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticias-form">

    <?php $dayNamesMin = ["D", "S", "T", "Q", "Q", "S", "S"];?>
    <?php $form = ActiveForm::begin(['id'=>'noticias-form', 'validateOnType' => true]); ?>

    <?= $form->field($model, 'interface')->label('Interface')->dropDownList([ 'todas' => 'Todas', 'opac' => 'OPAC', 'Interna' => 'STAFF'], ['prompt' => 'Selecione...']) ?>

    <?= $form->field($model, 'dataVisivel')->label('Data Visível')->textInput()->widget(DatePicker::className(),
        ['options' => ['class' => 'form-control'],'clientOptions' => ['changeMonth'=>true, 'changeYear'=>true,'dayNamesMin' => $dayNamesMin, 'minDate'=>0], 'dateFormat' => 'php:Y/m/d'])
        ->hint('Nota: Se introduzir uma data superior da atual, a notícia só será visível após a mesma.') ?>

    <?= $form->field($model, 'dataExpiracao')->label('Data de Expiração')->textInput()->widget(DatePicker::className(),
        ['options' => ['class' => 'form-control'],'clientOptions' => ['changeMonth'=>true, 'changeYear'=>true,'dayNamesMin' => $dayNamesMin, 'minDate'=>0], 'dateFormat' => 'php:Y/m/d'])
        ->hint('Nota: Ao consultar') ?>

    <?= $form->field($model, 'autor')->textInput(['maxlength' => true, 'value'=> $identity]) ?>

    <?= $form->field($model, 'assunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conteudo')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => $model->id], 'preset' => 'basic']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
