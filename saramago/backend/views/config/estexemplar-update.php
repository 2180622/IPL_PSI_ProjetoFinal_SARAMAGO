<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EstatutoExemplar */

?>
<div class="estatuto-exemplar-update">

    <?php $form = ActiveForm::begin(['id' => 'estatuto-exemplar-update']); ?>

    <?= $form->field($model, 'estatuto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prazo')->textInput()->hint('Evite introduzir o número 0') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>