<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obra-search">

    <h4>Filtros:</h4>

    <?php $form = ActiveForm::begin(['id' => 'obra-search',
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
        ],
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'imgCapa') ?>

    <?= $form->field($model, 'titulo')->textInput(['placeholder'=>'Título'])->label(false) ?>

    <?php //echo $form->field($model, 'resumo') ?>

    <?= $form->field($model, 'editor')->textInput(['placeholder'=>'Editor'])->label(false) ?>

    <?= $form->field($model, 'local')->textInput(['placeholder'=>'Local'])->label(false) ?>

    <?php echo $form->field($model, 'ano')->textInput(['maxlength' => 4,'placeholder'=>'Ano'])->label(false)  ?>

    <?php echo $form->field($model, 'tipoObra')
        ->dropDownList(['materialAv'=>'Material Audio-Visual','monografia'=> 'Monografia', 'pubPeriodica'=>'Publicação Periódica'],
            ['prompt'=>'Tipo de Obra'])->label(false) ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'edicao') ?>

    <?= $form->field($model, 'assuntos')->textInput(['placeholder'=>'Assunto'])->label(false) ?>

    <?php // echo $form->field($model, 'preco') ?>

    <?= $form->field($model, 'dataRegisto')->widget(DatePicker::className(), ['options' => ['class' => 'form-control']])
        ->textInput(['placeholder'=>'Data Registado'])->label(false) ?>

    <?php // echo $form->field($model, 'dataAtualizado') ?>

    <?= $form->field($model, 'Cdu_id')->dropDownList($cduAll,['prompt'=>'Código Decimal Universal...'])->label(false) ?>

    <?= $form->field($model, 'Colecao_id')->dropDownList($colecaoAll,['prompt'=>'Coleção...'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-create']) ?>
        <?= Html::resetButton('Repor', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
