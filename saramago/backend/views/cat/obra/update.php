<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = 'Update Obra: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="obra-update">

    <?php

    if ($scenario == 'materialAv')
    {
        echo $this->render('_formMonografia/_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]);

    }elseif ($scenario == 'monografia')
    {
        echo $this->render('_formMonografia/_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]);
    }
    elseif ($scenario == 'pubPeriodica')
    {
        echo $this->render('_formPubperiodica/_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]);
    }
    ?>

</div>
