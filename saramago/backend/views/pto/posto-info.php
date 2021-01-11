<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Postotrabalho */

$this->title = $model->designacao;
\yii\web\YiiAsset::register($this);
?>
<div class="site-pto posto-info">
    <div class="pull-right">
        <?= Html::button(FAS::icon('plus') . ' Adicionar',
            ['value' => Url::to(['reserva-create','idPosto'=>$model->id]), 'class' => 'btn btn-alt', 'id' => 'modalButtonCreate'])?>
        <?= Html::a(Html::button(FAS::icon('cog') . ' Configurar',
            ['class' => 'btn btn-alt']), Url::to('config/postos#'.$model->id))?>
    </div>
    <h4>
        <?= Html::encode($this->title)?> <small class="text-muted"><?=$model->biblioteca->codBiblioteca?></small>
        <?= Html::a(FAS::icon('info-circle'),'#collapseInfoPosto',['data-toggle'=>'collapse'])?>
    </h4>
    <div class="collapse" id="collapseInfoPosto">
        <hr>
        <div class="card card-body">
            <?php
            echo '<p>Total de Lugares: '. $model->totalLugares .'</p>';
            if($model->notaInterna != null)
            {
                echo '<p>Nota: '. $model->notaInterna .'</p>';
            }
            ?>
        </div>
    </div>
    <?php
    $this->registerJs(/**@lang JavaScript*/"
        $(function () {
            $('#modalButtonCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        })");
    ?>

</div>