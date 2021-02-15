<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=>'SARAMAGO (OPAC)',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'saramago-opac',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
        'urlManagerBackend' => [
            // Disable r= routes
            'enablePrettyUrl' => true,
            // Disable index.php
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                //catalogação
                'cat'=>'cat/index',
                //circulação
                //leitores
                'leitor'=>'leitor/index',
                'leitor/create'=>'leitor/create',
                'leitor/<id:[a-zA-Z0-9_]+>'=>'leitor/view-full',
                //FIXME 'leitor/<username:[a-zA-Z0-9_.]+>'=>'leitor/view-full'
                //postos de trabalho
                'pto'=>'pto/index',
                //index site
                'about'=>'site/about',
                //serviços reprográficos
            ],
        ],
    ],
    'params' => $params,

    // target language
    'language' => 'pt-PT',
    // source language
    'sourceLanguage' => 'en-US',
];
