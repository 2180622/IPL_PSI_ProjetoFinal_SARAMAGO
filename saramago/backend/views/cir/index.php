<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Circulação';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cir">

    <?php echo '  
        <div class="row container-fluid saramago-cir">
            <div class="col-md-4">
                <h3>Circulação</h3>
                <a href="' . Url::to(['cir/emprestimo#go']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('upload')->size(FAS::SIZE_LARGE).' Empréstimo</h5></div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['cir/devolucao#go']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('download')->size(FAS::SIZE_LARGE).' Devolução</h5></div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['cir/renovacao#go']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('retweet')->size(FAS::SIZE_LARGE).' Renovar</h5></div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['index']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('hourglass-half')->size(FAS::SIZE_LARGE).' Consultas Presenciais</h5></div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <h3>Reservas</h3>
                 <a href="' . Url::to(['index']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('user-clock')->size(FAS::SIZE_LARGE).' Fila de Espera</h5></div>
                    </div>
                 </a>
                 <br>
                 <a href="' . Url::to(['index']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('clock')->size(FAS::SIZE_LARGE).' Aguarda Recolha</h5></div>
                    </div>
                 </a>
                 <br>
                 <a href="' . Url::to(['index']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('stream')->size(FAS::SIZE_LARGE).' Não Levantados</h5></div>
                    </div>
                 </a>
            </div>
            <div class="col-md-4">
                <h3>Transferências</h3>
                 <a href="' . Url::to(['cir/transferencias']) . '">
                    <div class="card card-cir">
                        <div class="card-body"><h5>'. FAS::icon('exchange-alt')->size(FAS::SIZE_LARGE).' Transferências</h5></div>
                    </div>
                 </a>                 
            </div>
        </div>
    ' ?>
<br>
</div>
