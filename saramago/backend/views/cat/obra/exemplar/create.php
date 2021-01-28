<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exemplar */

$this->title = 'Criar Exemplar';
$this->params['breadcrumbs'][] = ['label' => 'Exemplares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar-create">

    <?php $form = ActiveForm::begin(['id' => 'exemplar-form']); ?>

    <?= $form->field($model, 'cota')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codBarras')->textInput(['maxlength' => true,
        'value' => str_pad($exemplarCount, 13, 0, STR_PAD_LEFT)])
        ->hint('Altere caso seja realmente necessário') ?>

    <?= $form->field($model, 'suplemento')->dropDownList([ '0' => 'Não', '1' => 'Sim' ])->label()?>

    <?= $form->field($model, 'estado') ->dropDownList(['estante'=>'Na Estante', 'nd'=>'Não Disponível'], ['prompt' => 'Selecione...'])
    ->label('Estado')
    ?>

    <?= $form->field($model, 'notaInterna')->textInput(['maxlength' => true])->label('Nota Interna') ?>

    <?= $form->field($model, 'Fundo_id')->dropDownList($fundoAll,['prompt'=>'Nenhum'])->label('Fundo') ?>

    <?= $form->field($model, 'Biblioteca_id')->dropDownList($bibliotecaAll, ['prompt' => 'Selecione...'])->label('Biblioteca') ?>

    <?= $form->field($model, 'EstatutoExemplar_id')->dropDownList($estatutoexemplarAll,['prompt' => 'Selecione...']) ?>

    <?= $form->field($model, 'TipoExemplar_id')->dropDownList($tipoexemplarAll["$tipoObra"],['prompt' => 'Selecione...']) ?>

    <?= $form->field($model, 'Obra_id')->hiddenInput(['value'=> $idObra])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
