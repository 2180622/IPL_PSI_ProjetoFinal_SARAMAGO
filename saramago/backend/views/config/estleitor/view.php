<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TipoLeitor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Leitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-leitor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'estatuto',
            'tipo',
            'nItens',
            'prazoDias',
            [
                'attribute' => 'registoOpac',
                'label' => 'Registo no OPAC?',
                'headerOptions' => ['width' => '50px'],
                'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
            ],
            'notas',
        ],
    ]) ?>

</div>