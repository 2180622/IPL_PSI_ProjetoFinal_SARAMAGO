<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Tabs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detalhes da obra';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exemplar">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nova reserva', ['exemplar-create'], ['class' => 'btn btn-create']) ?>
    </p>
<?php 
    echo '<h1>Reservas</h1>';
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Obras',
                'content' => 'Anim pariatur cliche...',
                'active' => true
            ],
            [
                'label' => 'Postos de trabalho ',
                'content' => 'Anim pariatur cliche...',
            ],
            [
                'label' => 'Example',
                'url' => 'http://www.example.com',
            ],
        ],
    ]);

?>