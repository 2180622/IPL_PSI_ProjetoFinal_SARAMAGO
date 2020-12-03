<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Config */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slidesopac-update">

    <?php $form = ActiveForm::begin(['id'=>'resexemplar']); ?>

    <?= $form->field($model, 'value')->label('Estado')->dropdownList([1 => 'Sim', 0 =>'Não']); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>