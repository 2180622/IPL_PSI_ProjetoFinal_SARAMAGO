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

    <?php // $form->field($model, 'id')->textInput(['placeholder'=>'Editor'])->label(false) ?>

    <?= $form->field($model, 'codBarras')->textInput(['placeholder'=>'Cód.Barras'])->label(false) ?>

    <?= $form->field($model, 'nome')->textInput(['placeholder'=>'Nome'])->label(false) ?>

    <?= $form->field($model, 'nif')->textInput(['placeholder'=>'NIF/NIPC'])->label(false) ?>

    <?= $form->field($model, 'docId')->textInput(['placeholder'=>'Doc. Id'])->label(false) ?>

    <?php // echo $form->field($model, 'dataNasc') ?>

    <?php // echo $form->field($model, 'morada') ?>

    <?php echo $form->field($model, 'localidade')->textInput(['placeholder'=>'Localidade'])->label(false) ?>

    <?php // echo $form->field($model, 'codPostal') ?>

    <?= $form->field($model, 'telemovel')->textInput(['placeholder'=>'Telemóvel'])->label(false) ?>

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
