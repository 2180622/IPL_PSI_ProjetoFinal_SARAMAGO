<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostotrabalhoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Postos de Trabalho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postotrabalho-index">

    <h1><?= Html::encode($this->title) ?>
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
    </h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'designacao',
            'totalLugares',
            'notaOpac',
            'notaInterna',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>

    <?php Pjax::end(); ?>

</div>