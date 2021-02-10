<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\ObraSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Obras';
$this->params['breadcrumbs'][] = 'Encontrar obras';
?>

<div class="rapido-pesquisa">
    <div class="center-block" style="text-align: -webkit-center;">
        <?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>
    </div>
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
            <?= Html::submitButton(Yii::t('app', 'Pesquisar'), ['class' => 'btn btn-success button-saramago']) ?>
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