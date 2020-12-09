<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Novo Funcionário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipa-update">

    <?php
    $listaRoles = array(
        'ADMIN' => 'admin',
        'operadorChefe' => 'Operador Chefe',
        'operadorCatalogacao' => 'Operador Catalogação',
        'operadorCirculacao' => 'Operador Circulação',
        'leitorFuncionario' => 'Leitor Funcionário',
        'leitorAluno' => 'leitorAluno',
        'leitorExterno' => 'leitorExterno',
        'leitorDocent' => ' Leitor Docente'
    );
    ?>

    <?php $form = ActiveForm::begin(['id'=>'equipa-update']); ?>

    <?= $form->field($model, 'role')->textInput(['disabled' => true])->label('Função Atual') ?>

    <?= $form->field($model, 'roleNova')->dropDownList($listaRoles)->label('Função Nova')
        ->hint('teSTE') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>