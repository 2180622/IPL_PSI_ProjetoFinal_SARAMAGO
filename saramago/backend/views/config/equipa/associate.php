<?php

use common\models\AuthAssignment;
use common\models\Leitor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Associar Funcionário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipa-associate">
    <?php
    $listaRoles = array('admin' => 'Admin',
                        'operadorChefe' =>'Operador Chefe',
                        'operadorCatalogacao' => 'Operador Catalogação',
                        'operadorCirculacao' => 'Operador Circulação',
                        'leitorDocente' => 'Leitor Docente',
                        'leitorFuncionario' => 'Leitor Funcionário',
                        'leitorAluno' => 'Leitor Aluno',
                        'leitorExterno' => 'Leitor Externo',
                        );
    $form = ActiveForm::begin(['id'=>'_formassociate']);
    ?>

    <?= $form->field($model, 'Leitor_id')->dropDownList(ArrayHelper::map($leitores,'id','nome',['enctype' => 'multipart/form-data']))->label('Leitor')?>

    <?php   $leitor = Leitor::findOne($leitores);
            $Auth = AuthAssignment::find()->where("user_id = " . $leitor->user_id)->one();
            $role = $Auth->item_name;?>
    <?= $form->field($model, 'role')->textInput(['disabled' => true, 'placeholder' => $role])->label('Função Atual') ?>

    <?= $form->field($model, 'roleNova')->dropDownList($listaRoles)->label('Nova Função') ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>