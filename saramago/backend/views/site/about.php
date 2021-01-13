<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Sobre';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h3>Criado por:</h3>
            <br>
            <p style="line-height: 1.5em">
                André Filipe Andrade Machado - <a class="noicon"
                                                  title="Enviar mensagem de correio electrónico para André Machado utilizando o seu cliente de correio"
                                                  href="mailto:2180622@my.ipleiria.pt"
                                                  target="_blank">2180622</a>
                <br>Gonçalo Bertão Coelho da Rocha - <a class="noicon"
                                                        title="Enviar mensagem de correio electrónico para Gonçalo Rocha utilizando o seu cliente de correio"
                                                        href="mailto:2180659@my.ipleiria.pt"
                                                        target="_blank">2180659</a>
                <br>Rui Pereira - <a class="noicon"
                                     title="Enviar mensagem de correio electrónico para Rui Pereira utilizando o seu cliente de correio"
                                     href="mailto:2180696@my.ipleiria.pt"
                                     target="_blank">2180696</a>
                <br><br>
                Projeto Final <br>
                TeSP Programação de Sistemas de Informação (PSI) 2020/2021,<br>
                2021 © Escola Superior de Tecnologia de Gestão - Politécnico de Leiria
            </p>
        </div>
        <div class="col-md-6">
            <h3>Informação do sistema:</h3>
            <br>
            <p>Sistema operativo <small class="text-muted"><?= PHP_OS ?></small></p>
            <p>Servidor Web <small class="text-muted"><?= apache_get_version() ?></small></p>
            <p>Servidor BD <small class="text-muted">
                    <?= Yii::$app->db->dsn ?></small></p>
            <br>
            <h3>Informação da plataforma:</h3>
            <br>
            <p><?= Yii::$app->name ?><small class="text-muted"><?= Yii::$app->version ?></small></p>
            <p><small class="text-muted">Sistema de Gestão de Bibliotecas Académicas</small></p>
            <p><small class="text-muted"><?= Yii::powered() ?> (<?= Yii::getVersion() ?>)</small></p>
            <p>Extensões: </p>
            <?php foreach (Yii::$app->extensions as $ext => $ext2)
            {
                echo Html::tag('li',
                    FAS::icon('tag') .' '. $ext,
                    ['class' => 'badge badge-secondary','style' => 'margin: 2px;']);
            }?>
        </div>
    </div>
</div>
