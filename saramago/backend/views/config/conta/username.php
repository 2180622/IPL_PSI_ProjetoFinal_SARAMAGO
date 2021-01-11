<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChangeUsernameForm */
/* @var $form ActiveForm */
?>
<div class="conta-password-form">

    <?php $form = ActiveForm::begin(['id'=>'username-form']); ?>

    <?= $form->field($model, 'oldUsername')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'username', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'retypeUsername')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>