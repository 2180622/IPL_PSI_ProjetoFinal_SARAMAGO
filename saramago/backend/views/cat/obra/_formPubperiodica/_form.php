<?php

use common\models\Cdu;
use common\models\Colecao;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\obra */
/* @var $model common\models\pubperiodica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obra-form">

    <?php $form = ActiveForm::begin(['id'=>'obra-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php

    if($model->imgCapa != null) {
        echo $form->field($model, 'imageFile')->label(false)->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => [Url::toRoute('/img/' . $model->imgCapa)],
                    'initialPreviewAsData' => true,
                    'initialCaption' => $model->titulo,
                    'previewFileType' => 'image',
                    'browseLabel' => '',
                    'showUpload' => false,
                ],
            ]
        )->hint('Capa');
    }else{
        echo $form->field($model, 'imageFile')->label(false)->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'browseLabel' => '',
                    'showUpload' => false,
                ],
            ]
        )->hint('Capa');
    }
    ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resumo')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => $model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ano')->textInput(['maxlength' => true, 'pattern'=>'[0-9]{4}']) ?>

    <?= $form->field($model, 'tipoObra')->hiddenInput(['value'=> 'pubPeriodica'])->label(false) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assuntos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Cdu_id')->dropDownList($cduAll,['prompt'=>'Selecione...'])->label('Código Decimal Universal') ?>

    <?= $form->field($model, 'Colecao_id')->dropDownList($colecaoAll,['prompt'=>'Nenhuma'])->label('Coleção') ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'serie')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'ISSN')->textInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
