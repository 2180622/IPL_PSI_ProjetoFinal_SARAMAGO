<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cdu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cdu-form">

    <?php $form = ActiveForm::begin(['id'=>'cdu-form']); ?>

    <?= $form->field($model, 'codCdu')->textInput(['maxlength' => true])->label('Classificação Decimal Universal') ?>

    <?= $form->field($model, 'designacao')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
