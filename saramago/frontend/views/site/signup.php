<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'mail2') ?>

                <?= $form->field($model, 'nome') ?>

                <?= $form->field($model, 'nif') ?>

                <?= $form->field($model, 'docId') ?>

                <?= $form->field($model, 'dataNasc')->widget(\yii\jui\DatePicker::className(), ['options' => ['class' => 'form-control'], ])?>

                <?= $form->field($model, 'morada') ?>

                <?= $form->field($model, 'localidade') ?>

                <?= $form->field($model, 'codPostal') ?>

                <?= $form->field($model, 'telemovel') ?>

                <?= $form->field($model, 'telefone') ?>

                <?= $form->field($model, 'notaInterna')->textarea(['rows' => '6']) ?>


                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
