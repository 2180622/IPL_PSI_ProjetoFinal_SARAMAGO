<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\ObraSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Procurar Obra';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'action' => ['obra'],
    'method' => 'get',
    'options' => ['data-pjax' => 1, 'class' => 'item'],
    'fieldConfig' => [
        'template' => "{input}",
    ],
]); ?>
    </div>

        <h1><?= Html::encode($this->title) ?></h1>
    <!--<nobr><?= $form->field($model, 'titulo')->textInput(['placeholder' => 'Titulo da obra']) ?>-->

    <nobr>
        <?= $form->field($searchModel, 'pesquisaGeral')->textInput(['placeholder' => 'O que procura?'])  ?>
        <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-warning']) ?>
    </nobr>

<?php ActiveForm::end(); ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_pesquisaobra',
]); ?>