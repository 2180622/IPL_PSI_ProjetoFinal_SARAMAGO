<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model common\models\Biblioteca */
/* @var $searchModel app\models\BibliotecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->nome;
?>
<h1><?= Html::encode($this->title) ?></h1>
<br>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'designacao',
        'totalLugares',
        'notaOpac',
        'notaInterna',
    ],
]) ?>
