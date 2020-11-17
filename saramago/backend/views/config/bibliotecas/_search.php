<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BibliotecaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biblioteca-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codBiblioteca') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'notasOpac') ?>

    <?= $form->field($model, 'morada') ?>

    <?php // echo $form->field($model, 'localidade') ?>

    <?php // echo $form->field($model, 'codPostal') ?>

    <?php // echo $form->field($model, 'levantamento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

