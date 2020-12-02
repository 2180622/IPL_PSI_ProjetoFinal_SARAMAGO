<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="site-login saramago-login">
    <div class="row">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Preencha os seguintes campos para iniciar sessão:</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    Esqueceu-se da palavra-passe? <?= Html::a('Repor', ['site/request-password-reset']) ?>
                    <br>
                    Precisa de novo e-mail de verificação? <?= Html::a('Reenviar', ['site/resend-verification-email']) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-login', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
