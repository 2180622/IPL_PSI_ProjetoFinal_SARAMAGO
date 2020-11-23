<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login">

    <h2 class="saramago-login">
        <?=Html::img('@web/res/logo-saramago.png', ['style'=>'vertical-align:text-bottom','height'=>'50‰', 'alt'=>'SARAMAGO']) ?>
        <?= Html::encode('.staff') ?>
    </h2>
    <h3><?= Html::encode($this->title)?></h3>
    <p class="saramago-login">Preencha os seguintes campos para iniciar sessão:</p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn-login btn-block', 'name' => 'login-button']) ?>
    </div>

            <?php ActiveForm::end(); ?>
</div>