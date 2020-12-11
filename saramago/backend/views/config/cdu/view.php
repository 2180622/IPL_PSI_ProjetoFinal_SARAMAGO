<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cdu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cdus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cdu-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'codCdu',
                'label' => 'Código'
            ],
            'designacao:ntext',
        ],
        ]) ?>

</div>
