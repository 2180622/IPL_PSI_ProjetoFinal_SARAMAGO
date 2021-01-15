<?php

namespace api\modules\v1\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\IdentityInterface;

class LoginController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth']
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_XML,
            ],
        ];

        return $behaviors;
    }

    public function auth($username,$password)
    {
        $user = User::findOne(['username' => $username]);

        if($user!=null && $user->validatePassword($password))
        {
            $auth_key = $user->auth_key;

            return $auth_key;
        }
        throw new HttpException('401', 'O username ou a password está incorreta.');
    }
}