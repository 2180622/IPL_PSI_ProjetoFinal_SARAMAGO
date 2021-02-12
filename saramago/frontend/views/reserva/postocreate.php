<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reserva */

$this->title = 'Pedir nova reserva de posto de trabalho';
$this->params['breadcrumbs'][] = ['label' => 'Reserva de postos de trabalho', 'url' => ['posto']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posto-create">

    <?= $this->render('posto/_form',
        ['model' => $model, 'postoTrabalhoAll' => $postoTrabalhoAll, 'idDoLeitor' => $idDoLeitor]); ?>

</div>
