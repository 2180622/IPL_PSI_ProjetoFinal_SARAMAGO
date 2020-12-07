<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExemplarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exemplar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cota') ?>

    <?= $form->field($model, 'codBarras') ?>

    <?= $form->field($model, 'suplemento') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'notaInterna') ?>

    <?php // echo $form->field($model, 'Biblioteca_id') ?>

    <?php // echo $form->field($model, 'EstatutoExemplar_id') ?>

    <?php // echo $form->field($model, 'TipoExemplar_id') ?>

    <?php // echo $form->field($model, 'Obra_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
