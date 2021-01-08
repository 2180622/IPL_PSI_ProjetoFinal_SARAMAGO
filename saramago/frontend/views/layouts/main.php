<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Entidade;
use common\models\Logotipos;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <?php if(Logotipos::favicon() != null){
        $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to('@web/img/'.Logotipos::favicon())]);
    }?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    /* (1) Se tiver logotipo
     * (2) Se não tiver logotipo e tiver a designacao da entidade definida
     * (3) Se não tiver ambas
    */
    if(Logotipos::logotipo() != null){
        NavBar::begin([
            'brandLabel'=> Html::img('@web/img/'.Logotipos::logotipo(),['height' => '100%', 'alt'=> Entidade::designacao()]),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default navbar-expand-lg fixed-top',
                'style' => 'border-bottom: 1px solid black',
            ],
        ]);
    }
    elseif(Logotipos::logotipo() == null && Entidade::designacao()!= null){
        NavBar::begin([
            'brandLabel'=> Entidade::designacao(),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default navbar-expand-lg fixed-top',
                'style' => 'border-bottom: 1px solid black',
            ],
        ]);
    }else{
        NavBar::begin([
            'brandLabel'=> Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default navbar-expand-lg fixed-top',
                'style' => 'border-bottom: 1px solid black',
            ],
        ]);
    }
    /*
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/error']],
    ];
    */
    $menuItems = [
        //['label' => 'Home', 'url' => ['/site/index']],
        //['label' => 'About', 'url' => ['/site/about']],
        //['label' => 'Contact', 'url' => ['/site/contact']],

        //TODO Pesquisa
        ['label' => 'Pesquisa', 'url' => ['\index'],
         'items' =>[
                 ['label' =>'Obras', 'url' =>['/pesquisa/obra']],
                 ['label' =>'Autores', 'url' =>['/pesquisa/autor']],

         ],
        ],
        [
            'label' => 'Reserva', 'url'=>['/reserva/index'],
        ]
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
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
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?php
            if(Entidade::designacao()!= null){ echo Entidade::designacao();}
            else{echo Html::encode(Yii::$app->name);}?>
            <?= date('Y') ?>
        </p>

        <p class="pull-right">Powered by <?=Html::img('@web/res/logo-saramago.png',['height' => '20', 'alt'=>Yii::$app->name])?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
