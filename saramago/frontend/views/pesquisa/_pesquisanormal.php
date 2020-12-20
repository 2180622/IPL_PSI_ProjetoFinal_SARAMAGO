<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => ''],
    'attributes' => [
        [
            'attribute'=>'',
            //'value'=>$model->imgCapa,
            'value'=>Html::a(Html::img(Yii::$app->getUrlManager()->getBaseUrl() . "/" .$model->imgCapa, ['width'=>'192', 'height' => "256"]), $model->imgCapa),
            'format' => 'raw',
        ],
        [
            'attribute'=>'',
            'value'=>$model->titulo,
        ],
        [
            'attribute'=>'',
            'value'=>$model->assuntos,
        ],
        [
            'attribute'=>'',
            'value'=>$model->resumo,
        ],
        [
            'attribute'=>'',
            'value'=>$model->preco.' '.'€',
        ],
        // info
        [
            'attribute'=>'',
            'format' => 'raw',
            'value'=> Html::a(Yii::t('app','Comprar'), Url::toRoute(['contacto/create2'])),
        ],
    ],
]) ?>