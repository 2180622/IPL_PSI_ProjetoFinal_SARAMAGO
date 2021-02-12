<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ChangePasswordForm */
/* @var $form ActiveForm */
$this->title = 'Conta';
$this->params['breadcrumbs'][] = 'Conta';
?>
<div class="pesquisa-saramago fast-font">
    <div class="body-content">
    	<div class="center-block" style="text-align: -webkit-center;">
        	<?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>
        	<h1><?= Html::encode($this->title) ?></h1>
    	</div>

    	<div class="col-lg-3"></div>
		<div class="conta-password-form col-lg-6">

		    <?php $form = ActiveForm::begin(['id'=>'password-form', 'options' => ['data' => ['pjax' => true]]]); ?>

		    <?= $form->field($model, 'oldPassword',['enableAjaxValidation' => true, 'enableClientValidation'=>true])->passwordInput() ?>
		    <?= $form->field($model, 'newPassword',['enableAjaxValidation' => true, 'enableClientValidation'=>true])->passwordInput() ?>
		    <?= $form->field($model, 'retypePassword')->passwordInput() ?>

		    <div class="form-group">
		        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success button-saramago']) ?>
		    </div>
		    <?php ActiveForm::end(); ?>

		</div>
		<div class="col-lg-3"></div>
	</div>
</div>