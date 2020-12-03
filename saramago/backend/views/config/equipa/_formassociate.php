<?php

use common\models\Leitor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="leitor-form">

    <?php

    $listaleitores = ArrayHelper::map($leitores,'id','nome',['enctype' => 'multipart/form-data']);

    $form = ActiveForm::begin(['id'=>'_formassociate']); ?>

    <?= $form->field($model, 'departamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Leitor_id')->dropDownList($listaleitores)->label('Leitor') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>