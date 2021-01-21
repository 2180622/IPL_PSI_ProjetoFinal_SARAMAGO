<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = 'Criar Obra';
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="obra-create">
    <?php

    if ($scenario == 'materialAv')
    {
        echo $this->render('_formMaterialav/_form', ['model' => $model, 'cduAll' => $cduAll, 'colecaoAll' => $colecaoAll]);

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
