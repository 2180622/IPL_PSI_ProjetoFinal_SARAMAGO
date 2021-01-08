<?php

/* @var $this yii\web\View */

use yii\bootstrap\Button;
use yii\helpers\Html;

$this->title = 'SARAMAGO';
?>
<div class="site-index">

    <div class="body-content">

        <!-- SLIDESHOW -->
        <!-- TODO SLIDESHOW
            Se o slideshow tiver ativo na tab. config, aparece as últimas obras adquiquidas.
            Independemente da data de registo delas só aparece as que têm exemplares.
        -->
        <h3>Últimas obras adquiridas</h3>
        <hr>
        <div id="carousel-obras" class="carousel slide" data-ride="carousel">
            <!-- indicadores -->
            <ol class="carousel-indicators">
            	<?php $counter = 0;
            	if (isset($obrasRecentementeAdquiridas)) { 
            		foreach($obrasRecentementeAdquiridas as $obraRecenteAdquirida) { ?> 
            			<li data-target="#carousel-obras" data-slide-to=' + $counter + '></li>
            			<?= $counter++; 
            		}
            	}
            	?>
                <!-- <li data-target="#carousel-obras" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-obras" data-slide-to="1"></li>
                <li data-target="#carousel-obras" data-slide-to="2"></li>
                <li data-target="#carousel-obras" data-slide-to="3"></li>
                <li data-target="#carousel-obras" data-slide-to="4"></li>
                <li data-target="#carousel-obras" data-slide-to="5"></li>
                <li data-target="#carousel-obras" data-slide-to="6"></li> -->
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

            	<?php if (isset($obrasRecentementeAdquiridas)) { ?>
            		<?php foreach($obrasRecentementeAdquiridas as $obraRecenteAdquirida) { ?> 
            			 <div class="item">
            			 		<?=Html::img('@web/batata01.jpg',['height' => '20', 'alt'=>Yii::$app->name])?>
                				
            					<div class="carousel-caption">

                					<h3>Titulo: <?= $obraRecenteAdquirida->titulo ?> (<?= $obraRecenteAdquirida->ano ?>)</h3> 
                							<?php foreach($obraRecenteAdquirida->autors as $autorDaObra) { ?>          			
        										<p>Autor: <?= $autorDaObra->primeiroNome ?> <?= $autorDaObra->segundoNome ?> <?= $autorDaObra->apelido ?> </p>
			          							<?php } ?> 			                  			
                				</div>
                		 </div>
                		 
            		<?php } ?>
            	<?php } ?>
            	

                <div class="item active">
                    <?=Html::img('@web/batata01.jpg',['height' => '20', 'alt'=>Yii::$app->name])?>
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #1 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>

 				<!--
                <div class="item">
                    <img src="" alt="NOME DA OBRA #2 (ANO)" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #2 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>

                <div class="item">
                    <img src="" alt="NOME DA OBRA #3 (ANO)" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #3 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>

            <div class="item">
                    <img src="" alt="NOME DA OBRA #4 (ANO)" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #4 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>

                <div class="item">
                    <img src="" alt="NOME DA OBRA #5 (ANO)" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #5 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>
 
                <div class="item">
                    <img src="" alt="NOME DA OBRA #6 (ANO)" style="width:100%;">
                    <div class="carousel-caption">
                        <h3>NOME DA OBRA #6 (ANO)</h3>
                        <p>Autor/Autores</p>
                    </div>
                </div>

            </div>-->

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
            <h3>Noticias</h3>
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
        <h3>Tags</h3>
        <hr>
        <div class="row">
            <div class="panel-group col-lg-6">
                <div class="panel panel-default">
                    <!-- //TODO -->
                    <div class="panel-heading">Assuntos</div>
                    <div class="panel-body">
                        <?php if (isset($tagsDasObras)) { ?>
                            <?php foreach($tagsDasObras as $tag) { ?> 
                                <button type="button" class="btn btn-outline-light"> <?= $tag ?>  <span class="badge badge-light"> <?= $quantidadeDeLivrosNaMesmaTag[$tag] ?> </span></button>
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
                            <a href="../site/autor/view/<?=$autor->id?>"><button type="button" class="btn btn-outline-light"> <?=$autor->primeiroNome .' '. $autor->segundoNome .' '. $autor->apelido ?> <span class="badge badge-light">~</span></button></a>
                        <?php } ?> 
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">4</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">1</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">6</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">3</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">8</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">9</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">2</span></button>
                        <button type="button" class="btn btn-outline-light">Teste <span class="badge badge-light">1</span></button>
                    </div>
                </div>
            </div>
            <div class="panel-group col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Datas de publicação</div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-outline-light">2020 <span class="badge badge-light">4</span></button>
                        <button type="button" class="btn btn-outline-light">2019 <span class="badge badge-light">1</span></button>
                        <button type="button" class="btn btn-outline-light">2018 <span class="badge badge-light">6</span></button>
                        <button type="button" class="btn btn-outline-light">2017 <span class="badge badge-light">3</span></button>
                        <button type="button" class="btn btn-outline-light">2016 <span class="badge badge-light">8</span></button>
                        <button type="button" class="btn btn-outline-light">2015 <span class="badge badge-light">9</span></button>
                        <button type="button" class="btn btn-outline-light">2014 <span class="badge badge-light">2</span></button>
                        <button type="button" class="btn btn-outline-light">2013 <span class="badge badge-light">1</span></button>
                    </div>
                </div>
            </div>
        </div>

            <!--
            <div class="col-lg-4">

                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
            -->
        </div>
    </div>
</div>
