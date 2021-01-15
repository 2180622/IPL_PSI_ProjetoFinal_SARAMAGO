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

class LoginController extends ActiveController
{
    public $modelClass = 'common\models\User';
    public $modelLogin = 'common\models\LoginForm';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'actionLogin'],
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionLogin($username,$password)
    {
        $loginModel = new $this->modelLogin;

        $loginModel->username = $username;
        $loginModel->password = $password;

        $user = User::findByUsername($username);
        if($user!=null && $user->validatePassword($password))
        {
            return $user->id;
        }
        throw new HttpException('404', 'O username ou a password está incorreta.');

    }

}