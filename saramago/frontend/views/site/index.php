<?php

/* @var $this yii\web\View */

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Saramago';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rapido-saramago">
    <div class="body-content">
        <!-- SLIDESHOW -->
        <!-- TODO SLIDESHOW
            Se o slideshow tiver ativo na tab. config, aparece as últimas obras adquiquidas.
            Independemente da data de registo delas só aparece as que têm exemplares.
        -->
        <h1>Últimas obras adquiridas</h1>
        <hr>
        <div id="carousel-obras" class="carousel slide" data-ride="carousel">
            <!-- indicadores -->
            <ol class="carousel-indicators">
            	<?php $counter = 0;
            	if (isset($obrasRecentementeAdquiridas)) { 
            		foreach($obrasRecentementeAdquiridas as $obraRecenteAdquirida) { ?> 
            			<li data-target="#carousel-obras" data-slide-to=' + $counter + '></li>
            			<?php $counter++; 
            		}
            	}?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            	<?php if (isset($obrasRecentementeAdquiridas)) { ?>
                    <?php $primeiro = true; ?>
            		<?php foreach($obrasRecentementeAdquiridas as $obra) { ?> 
                        <?php if ($primeiro == true) { ?>
            			<div class="item active">
        			 		<?= Html::img('@web/img/' . $obra->imgCapa,['width' => '100%', 'alt'=> $obra->titulo . ' ('. $obra->ano .')'])?>
        					<div class="carousel-caption">
            					<h3>Titulo: <?= $obra->titulo ?> (<?= $obra->ano ?>)
                                </h3> 
        						<?php foreach($obra->autors as $autor) { ?>          			
        							<p>Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?> 
                                    </p>
          						<?php } ?> 			                  			
            				</div>
                		</div>
                        <?php $primeiro = false; ?>
                        <?php }
                        else { ?>  
                        <div class="item">
                            <?= Html::img('@web/img/' . $obra->imgCapa,['width' => '100%', 'alt'=> $obra->titulo . ' ('. $obra->ano .')'])?>
                            <div class="carousel-caption">
                                <h3>Titulo: <?= $obra->titulo ?> (<?= $obra->ano ?>)
                                </h3> 
                                <?php foreach($obra->autors as $autor) { ?>                     
                                    <p>Autor: <?= $autor->primeiroNome ?> <?= $autor->segundoNome ?> <?= $autor->apelido ?>
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
            <div>
                <h1>Noticias</h1>
                <table style="width:100%;">
                    <tr>
                        <th style="width: 10%;">Autor</th>
                        <th>Conteúdo</th>
                    </tr>
                    <tr>
                        <?php //TODO FIX NA DISPOSIÇÃO DA TABELA
                        foreach ($noticias as $noticia) {?>
                        <td><?php echo $noticia->autor .'</td>
                        <td>'; echo $noticia->conteudo .'</td>';
                        }?>
                    </tr>
                </table>
            </div>
            <!--TAGS-->
            <h1>Obras disponíveis em Saramago</h1>
            <hr>
            <div class="row">
                <div class="panel-group col-lg-6">
                    <div class="panel panel-default">
                        <!-- //TODO -->
                        <div class="panel-heading">Assunto</div>
                        <div class="panel-body">
                            <?php if (isset($tagsDasObras)) { ?>
                                <?php foreach($tagsDasObras as $tag) { ?> 
                                    <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]', 
                                'pesquisaGeral'=> $tag]) ?>"><button type="button" class="btn btn-outline-light"> <?= $tag ?>  <span class="badge badge-light"> <?= $quantidadeDeLivrosNaMesmaTag[$tag] ?> </span></button></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="panel-group col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Autor</div>
                        <div class="panel-body">
                            <?php foreach ($autores as $autor) { ?>
                                <a href="<?= Url::toRoute(['/pesquisa/autor?AutorSearch[pesquisaGeral]', 
                                'pesquisaGeral'=> $autor->primeiroNome .' '.$autor->segundoNome .''.$autor->apelido]) ?>"><button type="button" class="btn btn-outline-light"> <?=$autor->primeiroNome .' '. $autor->segundoNome .' '. $autor->apelido ?> <span class="badge badge-light">
                                <?php if (isset($numeroDeObrasDoAutor[$autor->id-1])) { ?>
                                    <?= $numeroDeObrasDoAutor[$autor->id-1] ?>
                                <?php  } ?></span></button></a>
                            <?php } ?> 
                        </div>
                    </div>
                </div>
                <div class="panel-group col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Data de publicação</div>
                        <div class="panel-body">
                            <?php if (isset($anosDasObras)) { ?>
                                <?php foreach($anosDasObras as $ano) { ?> 
                                    <a href="<?= Url::toRoute(['/pesquisa/obra?ObraSearch[pesquisaGeral]', 
                                'pesquisaGeral'=> $ano]) ?>"><button type="button" class="btn btn-outline-light"> <?= $ano ?>  <span class="badge badge-light"> <?= $quantidadeDeLivrosDoMesmoAno[$ano]   ?> </span></button></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
