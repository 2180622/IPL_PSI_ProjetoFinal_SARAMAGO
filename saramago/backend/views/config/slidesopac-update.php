<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="config-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => true, 'validateOnChange' => true]); ?>

    <?= $form->field($model, 'info')->label('Definição')->textInput(['readonly' => true])?>

    <?= $form->field($model, 'value')->label('Estado')->dropdownList([1 => 'Sim', 0 =>'Não']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>