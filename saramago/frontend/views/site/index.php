<?php

/* @var $this yii\web\View */

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Saramago';
?>
<div class="rapido-saramago">
    <div class="center-block">
        <?= Html::img('@web/res/logo-saramago.png',['height' => '100px', 'alt'=> 'Saramago']) ?>
    </div>

    <div class="body-content">
        <!-- SLIDESHOW -->
        <!-- TODO SLIDESHOW
            Se o slideshow tiver ativo na tab. config, aparece as últimas obras adquiquidas.
            Independemente da data de registo delas só aparece as que têm exemplares.
        -->
        <div class="col-lg-6">
            <h3>Últimas obras adquiridas</h3>
            <div id="carousel-obras" class="panel panel-default carousel slide col-lg-12" style="" data-ride="carousel">
                
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
                <div class="carousel-inner" id="obra">
                    <?php if (isset($obrasRecentementeAdquiridas)) { ?>
                        <?php $primeiro = true; ?>
                        <?php foreach ($obrasRecentementeAdquiridas as $obra) { ?>
                            <?php if ($primeiro == true) { ?>
                                <div class="item active">
                                    <?= Html::img('@web/img/' . $obra->imgCapa, ['width' => '100%', 'alt' => $obra->titulo . ' (' . $obra->ano . ')']) ?>
                                    <div class="carousel-caption">
                                        <h3 class="contrast-text"><?= $obra->titulo ?> (<?= $obra->ano ?>)
                                        </h3>
                                        <?php foreach ($obra->autors as $autor) { ?>
                                            <p class="contrast-text">
                                                Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php $primeiro = false; ?>
                            <?php } else { ?>
                                <div class="item">
                                    <?= Html::img('@web/img/' . $obra->imgCapa, ['width' => '100%', 'alt' => $obra->titulo . ' (' . $obra->ano . ')']) ?>
                                    <div class="carousel-caption">
                                        <h3 class="contrast-text"><?= $obra->titulo ?> (<?= $obra->ano ?>)
                                        </h3>
                                        <?php foreach ($obra->autors as $autor) { ?>
                                            <p class="contrast-text">
                                                Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?>
                                            </p>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <!-- Controldores / esquerda e direita -->
                    <a class="left carousel-control" href="#carousel-obras" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-obras" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
                <br>
                <!-- NOTICIAS -->

            </div>
        </div>
        <div class="col-lg-6">
            <h3>Notícias</h3>
            <div id="carousel-noticias" class="panel panel-default carousel col-lg-12" style="" data-ride="carousel">
                
                <!-- indicadores -->
                <ol class="carousel-indicators">
                    <?php $counterNoticias = 0;
                    if (isset($noticias)) {
                        foreach ($noticias as $noticia) { ?>
                            <li data-target="#carousel-noticias" data-slide-to="<?=$counterNoticias?>"></li>
                            <?php $counterNoticias++;
                        }
                    } ?>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php if (isset($noticias)) { ?>
                        <?php $primeiro = true; ?>
                        <?php foreach ($noticias as $noticia) { ?>
                            <?php if ($primeiro == true) { ?>
                                <div class="item active">
                                    <div class="carousel-caption">
                                        <h3><?= $noticia->autor ?>
                                        </h3>
                                        <h4><?= $noticia->conteudo ?></h4>
                                    </div>
                                </div>
                                <?php $primeiro = false; ?>
                            <?php } else { ?>
                                <div class="item">
                                    <div class="carousel-caption">
                                        <h3><?= $noticia->autor ?>
                                        </h3>
                                        <h4><?= $noticia->conteudo ?></h4>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <!-- Controldores / esquerda e direita -->
                </div>
                <br>
                <!-- NOTICIAS -->

            </div>
        </div>

        <div class="col-lg-12">
            <h3>Obras disponíveis</h3>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <!-- //TODO -->
                    <div class="panel-heading">Assuntos</div>
                    <div class="panel-body">
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
                    <div class="panel-body">
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
                    <div class="panel-body">
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
</div>
