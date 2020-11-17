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
        'codBiblioteca',
        'nome',
        'notasOpac:html',
        'morada',
        'localidade',
        [
            'attribute' => 'codPostal',
            //FIXME descobrir como aplicar o pattern
            //'contentOptions'=>[,['^\d{4}(-\d{4})?$']],
        ],
        [
            'attribute' => 'levantamento',
            'format'=>['boolean',['0' => 'Não', '1' => 'Sim']],
            'filter' => ['0' => 'Não', '1' => 'Sim'],
        ],
    ],
]) ?>