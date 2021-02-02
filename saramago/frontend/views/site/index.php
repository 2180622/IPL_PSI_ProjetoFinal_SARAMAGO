<?php

/* @var $this yii\web\View */

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Saramago';
?>
<div class="rapido-saramago">
    <div class="center-block">
        <?= Html::img('@web/res/logo-saramago.png',['height' => '75px', 'alt'=> 'Saramago']) ?>
    </div>

    <div class="body-content">
        <!-- SLIDESHOW -->
        <!-- TODO SLIDESHOW
            Se o slideshow tiver ativo na tab. config, aparece as últimas obras adquiquidas.
            Independemente da data de registo delas só aparece as que têm exemplares.
        -->
        <div class="col-lg-6">
            <h3>Últimas obras adquiridas</h3>
            <div id="carousel-obras" class="panel panel-default carousel slide col-lg-12" style="padding-top: 20px;" data-ride="carousel">
                
                <!-- indicadores -->
                <ol class="carousel-indicators">
                    <?php $counterObras = 0;
                    if (isset($obrasRecentementeAdquiridas)) {
                        foreach ($obrasRecentementeAdquiridas as $obraRecenteAdquirida) { ?>
                            <li data-target="#carousel-obras" data-slide-to="<?=$counterObras?>"></li>
                            <?php $counterObras++;
                        }
                    } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php if (isset($obrasRecentementeAdquiridas)) { ?>
                        <?php $primeiro = true; ?>
                        <?php foreach ($obrasRecentementeAdquiridas as $obra) { ?>
                            <?php if ($primeiro == true) { ?>
                                <div class="item active">
                                    <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]', 'pesquisaGeral' => $obra->titulo]) ?>">
                                    <?= Html::img('@web/img/' . $obra->imgCapa, ['width' => '100%', 'class' => 'bookgraphic']) ?>
                                    </a>
                                    <div class="carousel-caption">
                                        <h4 class="contrast-text bookgraphic-text"><?= $obra->titulo ?> (<?= $obra->ano ?>)
                                        </h4>
                                        <?php foreach ($obra->autors as $autor) { ?>
                                            <h5 class="contrast-text bookgraphic-text">
                                                Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?>
                                            </h5>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php $primeiro = false; ?>
                            <?php } else { ?>
                                <div class="item">
                                    <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]', 'pesquisaGeral' => $obra->titulo]) ?>">
                                    <?= Html::img('@web/img/' . $obra->imgCapa, ['width' => '100%', 'class' => 'bookgraphic']) ?>
                                    </a>
                                    <div class="carousel-caption">
                                        <h4 class="contrast-text bookgraphic-text"><?= $obra->titulo ?> (<?= $obra->ano ?>)
                                        </h4>
                                        <?php foreach ($obra->autors as $autor) { ?>
                                            <h5 class="contrast-text bookgraphic-text">
                                                Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?>
                                            </h5>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
                <br>
            </div>
        </div>
        <div class="col-lg-6" style="margin-bottom: 20px">
            <h3>Notícias</h3>
            <div id="carousel-noticias" class="panel panel-default noticia carousel col-lg-12" style="" data-ride="carousel">
                
                <!-- indicadores -->
                <ol class="carousel-indicators">
                    <?php $counterNoticias = 0;
                    if (isset($noticias)) {
                        foreach ($noticias as $noticia) { ?>
                            <?php if (date('Y-m-d H:i:s') > $noticia->dataVisivel && date('Y-m-d H:i:s') < $noticia->dataExpiracao 
                            && $noticia->interface == "opac" || $noticia->interface == "todas") { ?>
                                <li data-target="#carousel-noticias" data-slide-to="<?=$counterNoticias?>"></li>
                                <?php $counterNoticias++;
                            }
                        }
                    } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php if (isset($noticias)) { ?>
                        <?php $primeiro = true; ?>
                        <?php foreach ($noticias as $noticia) { ?>
                            <?php if (date('Y-m-d H:i:s') > $noticia->dataVisivel && date('Y-m-d H:i:s') < $noticia->dataExpiracao 
                            && $noticia->interface == "opac" || $noticia->interface == "todas") { ?>
                                <?php if ($primeiro == true) { ?>
                                    <div class="item item-noticia active">
                                        <div class="panel" style="background-color: rgb(239, 239, 239)">
                                            <h4><?= $noticia->assunto ?> </h4>
                                            <h5><?= $noticia->conteudo ?> </h5>
                                            <div class="col-lg-6" style="text-align: left; font-size: 14px;"><?= $noticia->autor ?> </div>
                                            <div class="col-lg-6" style="text-align: right; font-size: 14px;"><?= $noticia->dataVisivel ?> </div>
                                        </div>
                                    </div>
                                    <?php $primeiro = false; ?>
                                <?php } else { ?>
                                    <div class="item item-noticia">
                                        <div class="panel" style="background-color: rgb(239, 239, 239)">
                                            <h4><?= $noticia->assunto ?> </h4>
                                            <h5><?= $noticia->conteudo ?> </h5>
                                            <div class="col-lg-6" style="text-align: left; font-size: 14px;"><?= $noticia->autor ?> </div>
                                            <div class="col-lg-6" style="text-align: right; font-size: 14px;"><?= $noticia->dataVisivel ?> </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <!-- Controldores / esquerda e direita -->
                </div>
                <br>
            </div>
        </div>
        <h3>Obras disponíveis listadas por...</h3>
        <div class="panel-group col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Assuntos</div>
                <div class="panel-body obras-disponiveis">
                    <?php if (isset($tagsDasObras)) { ?>
                        <?php foreach ($tagsDasObras as $tag) { ?>
                            <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]',
                                'pesquisaGeral' => $tag]) ?>">
                                <button type="button" class="btn btn-outline-light"> <?= $tag ?> <span
                                            class="badge badge-light"> <?= $quantidadeDeLivrosNaMesmaTag[$tag] ?> </span>
                                </button>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="panel-group col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Autores</div>
                <div class="panel-body obras-disponiveis">
                    <?php foreach ($autores as $autor) { ?>
                        <a href="<?= Url::toRoute(['/pesquisa/autor?AutorSearch[pesquisaGeral]',
                            'pesquisaGeral' => $autor->primeiroNome . ' ' . $autor->segundoNome . '' . $autor->apelido]) ?>">
                            <button type="button"
                                    class="btn btn-outline-light"> <?= $autor->primeiroNome . ' ' . $autor->segundoNome . ' ' . $autor->apelido ?>
                                <span class="badge badge-light">
                            <?php if (isset($numeroDeObrasDoAutor[$autor->id - 1])) { ?>
                                <?= $numeroDeObrasDoAutor[$autor->id - 1] ?>
                            <?php } ?></span></button>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="panel-group col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">Datas de publicação</div>
                <div class="panel-body obras-disponiveis">
                    <?php if (isset($anosDasObras)) { ?>
                        <?php foreach ($anosDasObras as $ano) { ?>
                            <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]',
                                'pesquisaGeral' => $ano]) ?>">
                                <button type="button" class="btn btn-outline-light"> <?= $ano ?> <span
                                            class="badge badge-light"> <?= $quantidadeDeLivrosDoMesmoAno[$ano] ?> </span>
                                </button>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
