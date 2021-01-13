<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoexemplar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipoexemplar-form">

    <?php $form = ActiveForm::begin(['id' => 'tipoexemplar-form']); ?>

    <?= $form->field($model, 'designacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'materialAv' => 'Material Audio-Visual', 'monografia' => 'Monografia',
        'pubPeriodica' => 'Publicação Periódica', ], ['prompt' => 'Selecione...']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
