<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\ObraSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin([
    'action' => ['index '],
    'method' => 'get',
    'options' => ['data-pjax' => 1, 'class' => 'rapido-saramago'],
    'fieldConfig' => [
        'template' => "{input}",
    ],
]); ?>
    </div>

    <!--<nobr><?= $form->field($model, 'titulo')->textInput(['placeholder' => 'Titulo da obra']) ?>-->

    <nobr>
        <?= $form->field($searchModel, 'titulo')  ?>
        <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-warning']) ?>
    </nobr>

<?php ActiveForm::end(); ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_pesquisanormal',
]); ?>