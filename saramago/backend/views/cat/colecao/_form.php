<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Colecao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="colecao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tituloColecao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
