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
<div class="site-pto reservas-conf">

    <?php
    $user = \Yii::$app->user;
    $operador = $user->identity->username;

    ?>

    <?php $form = ActiveForm::begin(['id'=>'reservas-form','validateOnType' => true]); ?>

    <?= $form->field($model, 'estadoReserva')->dropDownList(['concluido' => 'Concluído', 'cancelado' => 'Cancelado', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'operador')->hiddenInput(['value'=> $operador])->label(false); ?>

    <?= $form->field($model, 'notaOpac')->widget(CKEditor::className(), ['options' => ['rows' => 4, 'id' => 'nO'.$model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'notaInterna')->widget(CKEditor::className(), ['options' => ['rows' => 4, 'id' => 'nI'.$model->id], 'preset' => 'basic']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
