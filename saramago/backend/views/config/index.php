<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Administração';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <div class="alert alert-info alert-dismissible config" role="alert" id="alert-saramago">
        <strong>Sugestão:</strong> Personalize as definições pela ordem listada.
    </div>

    <?php echo '
        <div class="row container saramago-config">
            <div class="col-md-6">
                <h3>Conta</h3>
                <a href="' . Url::to(['config/conta']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>' . $identity . '</h4>Defina o seu username ou a sua password aqui</div>
                    </div>
                </a>
                <hr>
                <h3>Entidade</h3>
                <a href="' . Url::to(['config/entidade']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Entidade</h4>Defina os dados da entidade</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/bibliotecas']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Bibliotecas</h4>Defina as bibliotecas da entidade</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/postos']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Postos de Trabalho</h4>Defina os postos de trabalho em cada biblioteca</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/logotipos']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Logótipos</h4>Defina os logótipos da entidade</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/noticias']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Notícias</h4>Disponibilize informações importantes aos leitores ou a sua staff </div>
                    </div>
                </a>
                <h3>Gestão da Equipa</h3>
                <a href="' . Url::to(['config/equipa']) . '">
                    <div class="card card-config" id="equipa">
                        <div class="card-body"><h4>Gestão da Equipa</h4>Defina os operadores do SARAMAGO</div>
                    </div>
                </a>
                <h3>Catálogo</h3>
                <a href="' . Url::to(['config/tipoexemplar']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Tipos de Exemplares</h4>Defina os tipos de exemplares presente no seu catálogo</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/estexemplar']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Estatutos dos Exemplares</h4>Defina os estatutos de empréstimo de cada tipo de exemplar</div>
                    </div>
                </a> 
                <br>
                <a href="' . Url::to(['config/cdu']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>CDU</h4>Visualize e faça a edição do Código Decimal Universal</div>
                    </div>
                </a>            
            </div>
            <div class="col-md-6">
                <h3>Leitores</h3>
                <a href="' . Url::to(['config/estleitor']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Estatuto do Leitor</h4>Faça a edição dos estatutos dos leitores</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/irregularidades']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Irregularidades</h4>Faça a edição de diferentes irregularidades</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/cursos']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Cursos</h4>Faça a edição dos cursos dos leitores, do tipo Aluno</div>
                    </div>
                </a>
                <h3>Recibos</h3>
                <!-- TODO Recibos -->
                <a href="' . Url::to(['config/recibos']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Recibos</h4>Ative ou desative o envio dos recibos de confirmação</div>
                    </div>
                </a>
                <h3>OPAC</h3>
                <a href="' . Url::to(['config/resexemplar']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Reservas de Exemplares</h4>Ative ou desative o cancelamento de reservas de exemplares pelo leitor no OPAC</div>
                    </div>
                </a>
                <br>
                <a href="' . Url::to(['config/slidesopac']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Últimas obras adquiridas</h4>Ative ou desative a visualização das últimas obras adquiridas no OPAC</div>
                    </div>
                </a>
                <br>
                <h3>Aplicação móvel</h3>
                <a href="' . Url::to(['config/arrumacao']) . '">
                    <div class="card card-config">
                        <div class="card-body"><h4>Arrumação</h4>Ativação ou desativação da funcionalidade “Em arrumação”</div>
                    </div>
                </a>
            </div>
        </div>
    ' ?>
</div>
