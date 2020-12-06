<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Associar Funcionário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipa-associate">

    <?php

    $listaleitores = ArrayHelper::map($leitores,'id','nome',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_formassociate']); ?>

    <?= $form->field($model, 'Leitor_id')->dropDownList($listaleitores)->label('Leitor') ?>
    <!--TODO-->
    <!--
    Fazer um dropdownList par os seguintes roles
    'admin' => 'ADMIN',
    'operadorChefe' => 'Operador Chefe',
    'operadorCatalogacao'=>'Operador Catalogação',
    'operadorCirculacao'=>'Operador Circulação',
    'leitorFuncionario'=>'Leitor Funcionário',
    'leitorAluno'=>'Leitor Aluno',
    'leitorExterno'=>'Leitor Externo'
    -->
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>