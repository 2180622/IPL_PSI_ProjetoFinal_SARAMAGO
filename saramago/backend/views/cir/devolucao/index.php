<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Devolução';
$this->params['breadcrumbs'][] = ['label' => 'Circulação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="alert alert-info alert-dismissible config" role="alert" id="alert-saramago">
        <strong>Informação:</strong> Utilize o menu rápido para começar.
    </div>

<?php
    $this->registerJs("
            $(function () {
                if(location.hash == '#go'){
                    $('#rapido-saramago .nav a[href=\"#tab2\"]').tab('show');
                }
            });
    ");
?>


