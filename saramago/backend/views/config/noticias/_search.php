<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NoticiasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'interface') ?>

    <?= $form->field($model, 'dataVisivel') ?>

    <?= $form->field($model, 'dataExpiracao') ?>

    <?= $form->field($model, 'autor') ?>

    <?php // echo $form->field($model, 'assunto') ?>

    <?php // echo $form->field($model, 'conteudo') ?>

    <?php // echo $form->field($model, 'dataRegisto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
