<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChangeUsernameForm */
/* @var $form ActiveForm */
?>
<div class="conta-password-form">

    <?php $form = ActiveForm::begin(['id'=>'username-form', 'options' => ['data' => ['pjax' => true]]]); ?>

    <?= $form->field($model, 'oldUsername')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'newUsername') ?>
    <?= $form->field($model, 'retypeUsername') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>