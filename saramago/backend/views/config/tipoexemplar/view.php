<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model common\models\Biblioteca */
/* @var $searchModel app\models\BibliotecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->designacao;
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'designacao',
        [
            'attribute' => 'tipo',
            'label' => 'Grupo',
            'value' => function ($model) {
                if($model->tipo == 'materialAv'){ return 'Material Audio-Visual';}
                elseif ($model->tipo == 'monografia'){return 'Monografia';}
                elseif ($model->tipo == 'pubPeriodica'){return 'Publicação Periódica';}

                //TODO Ex: "Material Audio-Visual - CD"
            }
        ],
    ],
]) ?>