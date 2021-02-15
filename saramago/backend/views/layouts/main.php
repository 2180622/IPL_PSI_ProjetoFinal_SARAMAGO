<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\Entidade;
use common\models\Logotipos;
use backend\assets\AppAsset;
use common\models\Noticias;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
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
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        $noticias = Noticias::find()->where("interface='todas'")->orWhere("interface='Interna'");
        if($noticias->count() == 0){
            $menuItems[] =
                [
                    'label' => FAS::icon('newspaper')->size(FAS::SIZE_LARGE),
                    'encode'=> false,
                    'options' =>[
                        'data-toggle' => 'popover',
                        'data-container'=>'body',
                        'data-placement'=>'bottom',
                        'data-html'=> 1,
                        'data-title'=>'Noticias',
                        //FIXME Text-align (ver no 'saramago.css')
                        'data-content'=>'
                                <div class="container-fluid">'
                            .Html::tag('h3', FAS::stack()->icon('newspaper')->on(FAS::icon('ban')->addCssClass('text-danger')))
                            .Html::tag('p', 'Não existem notícias!').
                            '</div>',
                    ],
                ];
        }else{
            $menuItems[] =
            [
                'label' => FAS::icon('newspaper')->size(FAS::SIZE_LARGE),
                'encode'=> false,
                'options' =>[
                    'data-toggle' => 'popover',
                    'data-container'=>'body',
                    'data-placement'=>'bottom',
                    'data-html'=> 1,
                    'data-title'=>'Noticias',
                    'data-content'=>'
                        <div class="container-fluid">'.$this->render('_noticias',['noticias' => $noticias]).'</div>',
                    ],
            ];
        }

        $menuItems[] = [
            'label' => FAS::icon('user-circle') .' '. Yii::$app->user->identity->username,
            'encode'=> false,
            'items' => [
                [
                    'label'=> FAS::icon('sign-out-alt').' Logout',
                    'url'=>['/site/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                    'encode'=> false,

                ],
                '<li class="divider"></li>',
                '<li class="dropdown-header">Conta</li>',
                [
                    'label' => FAS::icon('user-cog').' Conta',
                    'url' => ['/config/conta'],
                    'encode'=> false,
                ],
                '<li class="divider"></li>',
                [
                    'label' => FAS::icon('info-circle').' Sobre',
                    'url' => ['site/about'],
                    'encode'=> false,
                ],
            ]
        ];
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
        <p class="pull-right" >Powered by <?=Html::a(Html::img('@web/res/logo-saramago.png',['height' => '20', 'alt'=>Yii::$app->name]), ['site/about'])?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
