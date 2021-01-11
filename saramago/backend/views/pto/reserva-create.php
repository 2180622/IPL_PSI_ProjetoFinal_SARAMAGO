<?php

use dosamigos\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Reservasposto */

$this->title = 'Create Reservasposto';
$this->params['breadcrumbs'][] = ['label' => 'Reservaspostos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-pto reservas-create">

    <?php
    $leitores = ArrayHelper::map($listLeitores,'id','nome',['enctype' => 'multipart/form-data']);
    $user = \Yii::$app->user;
    $operador = $user->identity->username;

    ?>

    <?php $form = ActiveForm::begin(['id'=>'reservas-form','validateOnType' => true]); ?>

    <?= $form->field($model, 'Leitor_id')->dropDownList($leitores, ['prompt'=>'Selecione...'])->label('Leitor') ?>

    <?= $form->field($model, 'dataReserva')->label('Data')->textInput()
        ->widget(DateTimePicker::className(),
            ['convertFormat' => true,'type' => DateTimePicker::TYPE_INPUT, 'pluginOptions' => ['autoclose'=>true, 'format' => 'yyyy-M-dd hh:mm','hoursDisabled' => '0,1,2,3,4,5,6,7']])
    ;?>

    <?= $form->field($model, 'estadoReserva')->hiddenInput(['value'=> 'reservado'])->label(false); ?>

    <?= $form->field($model, 'operador')->hiddenInput(['value'=> $operador])->label(false); ?>

    <?= $form->field($model, 'lugar')->label('Lugar')->dropDownList($totalLugares); ?>

    <?= $form->field($model, 'PostoTrabalho_id')->hiddenInput(['value'=> $idPosto])->label(false); ?>

    <?= $form->field($model, 'notaOpac')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => 'nO'.$model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'notaInterna')->widget(CKEditor::className(), ['options' => ['rows' => 4, 'id' => 'nI'.$model->id], 'preset' => 'basic']) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
