<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'name' => 'SARAMAGO API',
    'basePath' => dirname(__DIR__),
    //'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => false,
            'cookieValidationKey' => 'saramago-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'saramago-api',
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
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                //saramago
                'index'=>'site/index',
                //Saramago V1
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/',
                    'pluralize'=> false,
                ],
                //Login
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/login',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        "PUT validate_token/{id}/{token}"=>"validate_token",
                    ],
                    "tokens"=>[
                        '{id}' => '<id:\\d+>',
                        '{token}' => '<token:\\w+>'
                    ]
                ],
                //User
                //FIXME A estrutura da regra seguinte serve apenas e só de exemplo.
                /** @notice
                 * GET /users: list all users page by page;
                 * HEAD /users: show the overview information of user listing;
                 * POST /users: create a new user;
                 * GET /users/123: return the details of the user 123;
                 * HEAD /users/123: show the overview information of user 123;
                 * PATCH /users/123 and PUT /users/123: update the user 123;
                 * DELETE /users/123: delete the user 123;
                 * OPTIONS /users: show the supported verbs regarding endpoint /users;
                 * OPTIONS /users/123: show the supported verbs regarding endpoint /users/123.
                 */
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/user',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                        'GET user/{id}' => 'get_user',
                        'GET user_type/{id}' => 'get_user_type',
                        'PUT update_user/{id}'=> 'update_user'
                    ],

                ],
                //Leitores
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/leitor',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                        'GET user/{id}' => 'get_user',
                        'GET user_type/{id}' => 'get_user_type',
                        'PUT update_user/{id}'=> 'update_user'
                    ],

                ],
                //Catalogação
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/cat',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                    ],
                ],
                //Circulação
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/cir',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                    ],
                ],
                //Serviços Reprográficos
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/sr',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                    ],
                ],
                //Postos de Trabalho
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/pto',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                    ],
                ],
                //Administração
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/pto',
                    'pluralize'=> false,
                    'extraPatterns' => [
                        'GET user' => 'user',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,

    // target language
    'language' => 'pt-PT',
    // source language
    'sourceLanguage' => 'en-US',
];
