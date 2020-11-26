<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostotrabalhoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="postotrabalho-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'designacao') ?>

    <?= $form->field($model, 'totalLugares') ?>

    <?= $form->field($model, 'notaOpac') ?>

    <?= $form->field($model, 'notaInterna') ?>

    <?= $form->field($model, 'biblioteca') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
