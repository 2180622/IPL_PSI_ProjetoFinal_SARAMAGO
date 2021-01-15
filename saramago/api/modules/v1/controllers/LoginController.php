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

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'auth'],
            'only' => ['auth']
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
        $user = User::findByUsername($username);

        $u = User::findOne($user->id);

        if($user!=null && $user->validatePassword($password))
        {
            $response = [
                'username' => $u->username,
                'token' => $u->auth_key,
            ];
            return $response;
        }
        throw new HttpException('401', 'O username ou a password está incorreta.');

    }

    /*public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            return ['token' => Yii::$app->user->identity->getAuthKey()];
        } else {
            $model->validate();
            return $model;
        }
    }*/

}