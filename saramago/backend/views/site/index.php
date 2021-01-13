<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'SARAMAGO';
?>
<div class="site-index">
    <div class="container-fluid">
        <? //Logo ?>
        <?=Html::img('@web/res/logo-saramago.png', ['class'=>'logo-saramago','height'=>'70‰', 'alt'=>'SARAMAGO']) ?>
        <br>
        <? //TODO ?>
        <div class="rapido-saramago">
            <div class="tabbable tabs-below">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane fade in active">
                        <form class="form-inline"><input type="search" id="form-rapido" name="emprestimos" placeholder="Digite o código de barras ou o username..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <form class="form-inline"><input type="search" id="form-rapido" name="devolucao" placeholder="Digite o código de barras do exemplar..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab3" class="tab-pane fade">
                        <form class="form-inline"><input type="search" id="form-rapido" name="renovar" placeholder="Digite o código de barras do exemplar..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab4" class="tab-pane fade">
                        <form class="form-inline"><input type="search" id="form-rapido" name="pesquisarLeitores" placeholder="Digite o código de barras, numero, alias ou nome do leitor..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab5" class="tab-pane fade">
                        <form class="form-inline"><input type="search" id="form-rapido" name="pesquisarCatalogo" placeholder="Digite palavras para pesquisar no cátalogo..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Empréstimos</a></li>
                    <li><a href="#tab2" data-toggle="tab">Devolução</a></li>
                    <li><a href="#tab3" data-toggle="tab">Renovar</a></li>
                    <li><a href="#tab4" data-toggle="tab">Pesquisar Leitores</a></li>
                    <li><a href="#tab5" data-toggle="tab">Pesquisar no Catálogo</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br><br>
    <div class="body-content">
        <?php echo '
        <div class="row container saramago-dashboard">
            <div class="bottom-space col-md-4">
                <a href="'.Url::to(['/leitor/']).'">
                    <div class="card card-dash-saramago" id="leitores">
                        <div class="card-body">
                            <h3 class="card-title">Leitores</h3>
                            <p class="card-text">
                                Faça a gestão dos seus leitores aqui.
                            </p>
                        </div>
                    </div>
                </a>
                <br>
                <a href="'.Url::to(['/sr/']).'">
                    <div class="card card-dash-saramago">
                        <div class="card-body">
                            <h3 class="card-title">Serviços Reprográficos</h3>
                            <p class="card-text">
                                Pedidos de digitalização e impressão.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bottom-space col-md-4">
                <a href="'.Url::to(['/cat/index']).'">
                    <div class="card card-dash-saramago">
                        <div class="card-body">
                            <h3 class="card-title">Catálogo</h3>
                            <p class="card-text">
                                Gestão de obras, autores, coleções, e muito mais.
                            </p>
                        </div>
                    </div>
                </a>
                <br>
                <a href="'.Url::to(['/pto/']).'">
                    <div class="card card-dash-saramago">
                        <div class="card-body">
                            <h3 class="card-title">Postos de Trabalho</h3>
                            <p class="card-text">
                                Gestão de reservas de postos de trabalho.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="'.Url::to(['/cir/']).'">
                    <div class="card card-dash-saramago">
                        <div class="card-body">
                            <h3 class="card-title">Circulação</h3>
                            <p class="card-text">
                                Gestão de empréstimos, reservas e transferências.
                            </p>
                        </div>
                    </div>
                </a>
                <br>
                <a href="'.Url::to(['/config/']).'">
                    <div class="card card-dash-saramago" id="config">
                        <div class="card-body">
                            <h3 class="card-title">Administração</h3>
                            <p class="card-text">
                                Gestão do Saramago    .
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        '?>
    </div>
</div>
