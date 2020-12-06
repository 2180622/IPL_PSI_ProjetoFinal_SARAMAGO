<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EstatutoExemplar */

?>
<div class="estatuto-exemplar-update">

    <?php $form = ActiveForm::begin(['id' => 'tipoexemplar-update']); ?>

    <?= $form->field($model, 'designacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput()->dropdownList(['materialAv' => 'Material audiovisual', 'monografia' =>'Monografia', 'pubPeriodica' => 'Publicação periódica']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>