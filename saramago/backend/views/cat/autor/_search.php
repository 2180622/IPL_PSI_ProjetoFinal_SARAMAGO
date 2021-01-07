<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AutorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="autor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'primeiroNome') ?>

    <?= $form->field($model, 'segundoNome') ?>

    <?= $form->field($model, 'apelido') ?>

    <?= $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'bibliografia') ?>

    <?php // echo $form->field($model, 'dataNasc') ?>

    <?php // echo $form->field($model, 'nacionalidade') ?>

    <?php // echo $form->field($model, 'orcid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
