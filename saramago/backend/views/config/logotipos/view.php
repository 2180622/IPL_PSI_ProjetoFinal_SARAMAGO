<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LogotiposForm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="config-logotipos">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'key',
                'label'=> 'Imagem',
                'format'=>['image',['width'=>'50%','display'=>'block', 'alt'=>$model->info]],
                'contentOptions'=>['style' => 'inline', 'width'=>'auto'],
                'value' => function($model){
                    if($model->value != null){return Url::toRoute('/img/'. $model->value);}
                }
            ],
            [
                'attribute'=>'value',
                'label'=>'Caminho',
                'format'=>'raw',
                'value' => function($model){
                    if($model->value != null){return Url::toRoute('/img/'. $model->value);}
                }
            ],
        ],
    ]) ?>

</div>
