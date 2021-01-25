<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reenviar verificação';
?>
<div class="site-resend-verification-email saramago-login">
    <div class="row">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Um e-mail de verificação será enviado para si.</p>

            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form->field($model, 'email')->label('E-mail')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="pull-right" style="color:#999; text-align: center;">
                <p>Não precisa? <?= Html::a('Voltar', Yii::$app->request->referrer) ?></p>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>