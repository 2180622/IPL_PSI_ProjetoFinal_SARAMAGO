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
        'tipo',
    ],
]) ?>