<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posto-form">

    <?php $form = ActiveForm::begin(['id'=>'posto-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'dataReserva')->textInput()->widget(DateTimePicker::className(),
            ['convertFormat' => true, 'type' => DateTimePicker::TYPE_INPUT, 'pluginOptions' => ['autoclose'=>true, 'format' => 'yyyy-M-dd hh:mm']]);?>


    <?= $form->field($model, 'PostoTrabalho_id')->dropDownList($postoTrabalhoAll,['prompt'=>'Selecione...'])->label('Postos de trabalho') ?>

    <?= $form->field($model, 'lugar')->label('Numero de lugares necessários') ?>

    <?= $form->field($model, 'Leitor_id')->hiddenInput(['value'=> $idDoLeitor->id])->label(false) ?>

    <?= $form->field($model, 'operador')->hiddenInput(['value'=> ""])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
