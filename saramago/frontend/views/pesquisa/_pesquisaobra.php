<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model' => $model,
    'options' => ['class' => 'rapido-saramago'],
    'attributes' => [
        [
            'attribute'=>'',
            //'value'=>$model->imgCapa,
            'value'=>Html::a(Html::img('@web/img/' . $model->imgCapa, ['width'=>'192', 'height' => "256"]), $model->imgCapa),
            'format' => 'raw',
        ],
        [
            'attribute'=>'',
            'value'=>'Titulo da obra: '.$model->titulo,
        ],
        [
            'attribute'=>'',
            'value'=>'Assuntos: '.$model->assuntos,
        ],
        [
            'attribute'=>'',
            'value'=>'Resumo: '.$model->resumo,
        ],
        [
            'attribute'=>'',
            'value'=>'Preço: '.$model->preco.' '.'€',
        ],
        [
            'attribute'=>'',
            'value'=>function ($model) {

                $autores = [];    

                foreach($model->autors as $autor) {

                    $autores[] = $autor->primeiroNome . ' ' . $autor->segundoNome . ' ' . $autor->apelido;

                }
                if (implode(', ', $autores) == "") {
                    return 'Autoria: ---';
                }
                return 'Autoria: ' .implode(', ', $autores);

            },
        ],
        [
            'attribute'=>'',
            'value'=>'Ano: '.$model->ano,
        ]

    ],
]) ?>