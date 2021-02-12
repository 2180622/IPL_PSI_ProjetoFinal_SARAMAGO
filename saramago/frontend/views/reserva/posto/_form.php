<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posto-form fast-font">
    <div class="center-block" style="text-align: -webkit-center;">
            <?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>

            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="col-lg-3"></div>

        <div class="conta-password-form col-lg-6">

            <?php $form = ActiveForm::begin(['id'=>'posto-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'dataReserva')->textInput()->widget(DateTimePicker::className(),
                    ['convertFormat' => true, 'type' => DateTimePicker::TYPE_INPUT, 'pluginOptions' => ['autoclose'=>true, 'format' => 'yyyy-M-dd hh:mm']]);?>


            <?= $form->field($model, 'PostoTrabalho_id')->dropDownList($postoTrabalhoAll,['prompt'=>'Selecione...'])->label('Postos de trabalho') ?>

            <?= $form->field($model, 'lugar')->label('Lugar') ?>

            <?= $form->field($model, 'Leitor_id')->hiddenInput(['value'=> $idDoLeitor->id])->label(false) ?>

            <?= $form->field($model, 'operador')->hiddenInput(['value'=> "OPAC"])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success button-saramago']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3"></div>
    

</div>
