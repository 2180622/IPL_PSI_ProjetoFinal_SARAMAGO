<?php

use common\models\Cdu;
use common\models\Colecao;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\obra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obra-form">

    <?php $form = ActiveForm::begin(['id'=>'obra-form']); ?>

    <?php

    if($model->imgCapa != null) {
        echo $form->field($model, 'imgCapa')->label(false)->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'initialPreview' => [Url::toRoute('/img/' . $model->imgCapa)],
                    'initialPreviewAsData' => true,
                    'initialCaption' => $model->titulo,
                    'previewFileType' => 'image',
                    'browseLabel' => '',
                    'uploadClass' => 'btn btn-success',
                    'showUpload' => true,
                ]
            ]
        )->hint('Capa');
    }else{
        echo $form->field($model, 'imgCapa')->label(false)->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'browseLabel' => '',
                    'uploadClass' => 'btn btn-success',
                    'showUpload' => true,
                ]
            ]
        )->hint('Capa');
    }
    ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resumo')->widget(CKEditor::className(), ['options' => ['rows' => 6, 'id' => $model->id], 'preset' => 'basic']) ?>

    <?= $form->field($model, 'editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ano')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoObra')->dropDownList([ 'materialAv' => 'MaterialAv', 'monografia' => 'Monografia', 'pubPeriodica' => 'PubPeriodica', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'local')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assuntos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preco')->textInput() ?>

    <?= $form->field($model, 'dataAtualizado')->textInput() //TODO PASSAR PARA AUTOMATICO ?>



    <?= $form->field($model, 'Cdu_id')->dropDownList($cduAll,['prompt'=>'Selecione...'])->label('Código Decimal Universal') ?>

    <?= $form->field($model, 'Colecao_id')->dropDownList($colecaoAll, ['prompt'=>'Selecione...'])->label('Coleção') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
