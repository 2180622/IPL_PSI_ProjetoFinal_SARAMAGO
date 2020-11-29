<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\LogotiposForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logotipos-form">

    <?php $form = ActiveForm::begin(['id' => 'logotipos-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php
        if($model->value != null) {
            echo $form->field($model, 'imageFile')->label(false)->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'initialPreview' => [Url::toRoute('/img/' . $model->value)],
                        'initialPreviewAsData' => true,
                        'initialCaption' => $model->key,
                        'previewFileType' => 'image',
                        'browseLabel' => '',
                        'uploadClass' => 'btn btn-success',
                        'showUpload' => true,
                    ]
                ]
            )->hint($model->infoLogo($model->info));
        }else{
            echo $form->field($model, 'imageFile')->label(false)->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'browseLabel' => '',
                        'uploadClass' => 'btn btn-success',
                        'showUpload' => true,
                    ]
                ]
            )->hint($model->infoLogo($model->info));
        }
    ?>

  <!-- <div class="form-group">
        <?/*= Html::submitButton('Guardar', ['class' => 'btn btn-success']) */?>
   </div>-->

    <?php ActiveForm::end(); ?>

</div>
