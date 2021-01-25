<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Colecao */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Colecaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="colecao-view">

   <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Nº do Sistema',
                'attribute' => 'id',
            ],
            'tituloColecao',
            [
                'label' => 'Obras Agregadas',
                'format'=>'html',
                'template'=>'<tr><th{captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'value' => function ($model)
                    {
                        foreach ($model->getObras()->all() as $obra)
                        {
                            $obras[] = '<li>'.Html::a($obra->titulo.' ('.$obra->ano.')', Url::to(['obra-full', 'id'=>$obra->id])).' '.FAS::icon('external-link-alt')->size(FAS::SIZE_EXTRA_SMALL).'</li>';
                        }

                        if($model->getObras()->count() !=0)
                        {
                            return '<ul>'.implode($obras).'</ul><hr>Total: '.$model->getObras()->count();

                        }else{

                            return 'Total: 0';
                        }
                    },
            ],
        ],
    ]) ?>

</div>
