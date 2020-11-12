<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=>'SARAMAGO',
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
            'name' => 'advanced-frontend',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        //Mostrar imagens (res) do backend no frontend
        'urlManagerResBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '@backend/web/res',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

        //Mostrar imagens (img) do backend no frontend
        'urlManagerImgBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '@backend/web/img',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

    ],
    'params' => $params,
];
