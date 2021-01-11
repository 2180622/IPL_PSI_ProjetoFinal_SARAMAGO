<?php

/* @var $this yii\web\View */
/* @var $bibliotecaModel \common\models\Biblioteca */
/* @var $biblioteca \common\models\Biblioteca */
/* @var $postosModel \common\models\Postotrabalho */
/* @var $posto \common\models\Postotrabalho */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Postos de Trabalho';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-pto">

    <?php
    if($bibliotecasCount == 0)
    {
        echo '
                <div class="alert alert-warning config" role="alert">
                    <strong>Informação:</strong> Para usar este módulo tem que: <br>
                     - Adicionar, pelo menos, uma <b>biblioteca</b>, em "Administração / Bibliotecas / Adicionar" ou '.Html::a( 'clicando aqui',['config/bibliotecas#create']).'.<br>
                     - Adicionar, pelo menos, um <b>posto de trabalho</b>, em "Administração / Postos de Trabalho / Adicionar".
                </div>
            ';

    }elseif($postosCount == 0)
    {
        echo '
                <div class="alert alert-warning config" role="alert">
                    <strong>Informação:</strong> Para usar este módulo tem que: <br>
                     - Adicionar, pelo menos, um <b>posto de trabalho</b>, em "Administração / Postos de Trabalho / Adicionar" ou '.Html::a( 'clicando aqui',['config/postos#create']).'.<br>
                </div>
            ';

    }else{

        echo'
            <div class="grid-container">
                <div class="menu-search-saramago">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
        foreach($bibliotecasModel as $biblioteca)
        {   echo '
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$biblioteca->codBiblioteca.'" aria-expanded="true" aria-controls="collapseOne">
                                '.$biblioteca->nome.' ('.$biblioteca->codBiblioteca.')'.'
                            </a>
                        </h4>
                    </div>
                    <div id="'.$biblioteca->codBiblioteca.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">';
                            if($biblioteca->postotrabalhos == null)
                                {
                                    echo 'Não tem postos de trabalho associados';
                                }
                                else{
                                    foreach ($biblioteca->postotrabalhos as $posto)
                                    {
                                        echo '<div>'.Html::button(FAS::icon('briefcase') . ' ' . $posto->designacao,
                                                ['value' => Url::to(['posto-info','id'=>$posto->id]), 'class' => 'btn btn-alt','style'=>'margin: 2px;', 'id' => 'infoButtonPosto'.$posto->id]).'</div>';

                                        $this->registerJs(/**@lang JavaScript*/"
                                            $(function () {
                                                $('#infoButtonPosto".$posto->id."').click(function (){
                                                    $('.menu-nav-saramago').removeClass('hidden');
                                                    $('.menu-table-saramago').removeClass('hidden');
                                                    $('.alert-start').addClass('hidden');
                                                    $('.menu-nav-saramago').load($(this).attr('value'))
                                                    $('.menu-table-saramago').load('pto/posto-reservas?idPosto=".$posto->id."')
                                                })
                                            });
                                        ");
                                    }
                                }
            echo'       </div>
                    </div>
                </div>';
        }
        echo'</div>';

        echo'        
                </div>
                <div class="alert alert-info config alert-start" role="alert" id="alert-saramago">
                    <strong>Informação:</strong> Para começar, selecione o posto de trabalho da biblioteca em questão.
                </div>
                <div class="menu-nav-saramago hidden">
                    <div style="text-align:center; color: #FFFFFF">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div>
                </div>
                <div class="menu-table-saramago hidden">
                    <div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div>
                </div>
            </div>
        ';

    }?>

    <?php
    $this->registerJs(/**@lang JavaScript*/ "
        $(function () {
            var idHash = location.hash;
            
            if(idHash != null && idHash !== '' && idHash.length >3){
                idHash = idHash.substring(1);
                var idPosto = idHash.split('-',1);
                var idReserva = idHash.substring(2);
                
                if(idPosto && idPosto.length >0){
                    $('.menu-nav-saramago').removeClass('hidden');
                    $('.menu-table-saramago').removeClass('hidden');
                    $('.alert-start').addClass('hidden');
                    $('.menu-nav-saramago').load('posto-info?id='+idPosto)
                    $('.menu-table-saramago').load('posto-reservas?idPosto='+idPosto)
                    $('#modalReservaView'+idPosto).modal('show')
                       .find('#modalContent')
                       .load('reserva-view?id='+idReserva)
                }
                    
            }
                    
        });
    ");
    ?>

    <?php
    Modal::begin([
        'header' => '<h4>Nova Reserva</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php
        foreach($reservas as $reserva)
        {
            Modal::begin([
                'header' => '<h4>Reserva</h4>',
                'id' => 'modalReservaView'. $reserva->id,
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static']
            ]);
            echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
            Modal::end();

            Modal::begin([
                'header' => '<h4>Reserva</h4>',
                'id' => 'modalReservaUpdate'. $reserva->id,
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static']
            ]);
            echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
            Modal::end();

            Modal::begin([
                'header' => '<h4>Reserva</h4>',
                'id' => 'modalReservaConf'. $reserva->id,
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static']
            ]);
            echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
            Modal::end();
        }
    ?>

</div>