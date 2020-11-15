<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-expand-lg fixed-top',
            'style' => 'border-bottom: 1px solid black',
        ],
    ]);
    /*
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/error']],
    ];
    */
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] = '<li>'.Html::a((FAS::icon('question-circle')->size(FAS::SIZE_LARGE)),'').'</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="layout-minor-top fixed-top">
        <?=Html::a(Html::img('@web/res/logo-saramago.png', ['height'=>'30‰', 'alt'=>'SARAMAGO']), ''.Yii::$app->homeurl.'')?>
        <div class="rapido-saramago" id="layout-minor">
            <div class="tabbable tabs-below">
                <div class="tab-content">
                    <div id="tab1" class="tab-pane active">
                        <form class="form-inline"><input type="search" id="form-rapido" name="emprestimos" placeholder="Digite o código de barras ou o username..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab2" class="tab-pane">
                        <form class="form-inline"><input type="search" id="form-rapido" name="devolucao" placeholder="Digite o código de barras do exemplar..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab3" class="tab-pane">
                        <form class="form-inline"><input type="search" id="form-rapido" name="renovar" placeholder="Digite o código de barras do exemplar..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab4" class="tab-pane">
                        <form class="form-inline"><input type="search" id="form-rapido" name="pesquisarLeitores" placeholder="Digite o código de barras, numero, alias ou nome do leitor..."><button type="submit" value="Submit">Submeter</button></form>
                    </div>
                    <div id="tab5" class="tab-pane">
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
    <br>
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right">Powered by <?=Html::img('@web/res/logo-saramago.png',['height' => '20', 'alt'=>Yii::$app->name])?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
