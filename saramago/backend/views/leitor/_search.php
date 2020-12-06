<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeitorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leitor-search">

    <h4>Filtros:</h4>

    <?php $form = ActiveForm::begin(['id'=>'leitor-search',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'codBarras') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'nif') ?>

    <?= $form->field($model, 'docId') ?>

    <?php // echo $form->field($model, 'dataNasc') ?>

    <?php // echo $form->field($model, 'morada') ?>

    <?php // echo $form->field($model, 'localidade') ?>

    <?php // echo $form->field($model, 'codPostal') ?>

    <?php // echo $form->field($model, 'telemovel') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'mail2') ?>

    <?php // echo $form->field($model, 'notaInterna') ?>

    <?php // echo $form->field($model, 'dataRegisto') ?>

    <?php // echo $form->field($model, 'dataAtualizado') ?>

    <?php // echo $form->field($model, 'Biblioteca_id') ?>

    <?php // echo $form->field($model, 'TipoLeitor_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-create']) ?>
        <?= Html::resetButton('Repor', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
