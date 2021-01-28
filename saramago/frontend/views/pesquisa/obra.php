<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\ObraSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Encontrar obras';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rapido-pesquisa">
    <?php $form = ActiveForm::begin([
        'action' => ['obra'],
        'method' => 'get',
        'options' => ['data-pjax' => 1, 'class' => 'rapido-pesquisa'],
        'fieldConfig' => [
            'template' => "{input}",
        ],
    ]); ?>

            <h1><?= Html::encode($this->title) ?></h1>

        <nobr>
            <?= $form->field($searchModel, 'pesquisaGeral')->textInput(['placeholder' => 'O que procura?'])  ?>
            <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-warning']) ?>
        </nobr>

    <?php ActiveForm::end(); ?>

    <br>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_pesquisaobra',
        'itemOptions' => [
        'class' => 'item-class',
        ],
        'options' => ['class' => 'parent-class'],    
        'layout' => "<div class='parent-class'>{items}</div>"
    ]); ?>
</div>