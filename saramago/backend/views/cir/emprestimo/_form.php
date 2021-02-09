<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'requisitar-form',
    //'layout'=>'inline',
    'options' => ['enctype' => 'multipart/form-data'],
]);
echo '<div class="row">';
echo '<div class="col-md-10">';
echo $form->field($emprestimoModel, 'codBarras',['enableAjaxValidation' => true])
    ->label(false)
    ->textInput(['placeholder'=>'Digite o código de barras do exemplar...']);
echo $form->field($emprestimoModel, 'Leitor_id')->label(false)->hiddenInput(['value'=> $leitorId]);
echo '</div>';
echo '<div class="col-md-offset-2">';
echo Html::submitButton('Submeter', ['class' => 'btn btn-create']);
echo '</div>';
echo '</div>';

ActiveForm::end();