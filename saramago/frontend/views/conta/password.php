<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChangePasswordForm */
/* @var $form ActiveForm */
$this->title = 'Saramago';
?>
<div class="pesquisa-saramago">
    <div class="body-content">
		<div class="conta-password-form">

		    <?php $form = ActiveForm::begin(['id'=>'password-form', 'options' => ['data' => ['pjax' => true]]]); ?>

		    <?= $form->field($model, 'oldPassword',['enableAjaxValidation' => true, 'enableClientValidation'=>true])->passwordInput() ?>
		    <?= $form->field($model, 'newPassword',['enableAjaxValidation' => true, 'enableClientValidation'=>true])->passwordInput() ?>
		    <?= $form->field($model, 'retypePassword')->passwordInput() ?>

		    <div class="form-group">
		        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
		    </div>
		    <?php ActiveForm::end(); ?>

		</div>
	</div>
</div>