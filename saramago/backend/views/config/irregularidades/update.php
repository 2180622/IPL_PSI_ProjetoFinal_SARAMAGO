<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoirregularidade */

$this->title = 'Irregularidades';
$this->params['breadcrumbs'][] = ['label' => 'Tipoirregularidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipoirregularidade-update">

    <?php $form = ActiveForm::begin(['id' => 'tipoirregularidade-update']); ?>

    <?= $form->field($model, 'diasAtivacao')->textInput() ?>

    <?= $form->field($model, 'diasBloqueio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>