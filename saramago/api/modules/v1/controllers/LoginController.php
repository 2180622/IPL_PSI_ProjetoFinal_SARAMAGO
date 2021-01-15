<?php


namespace api\modules\v1\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\HttpException;

class LoginController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => [$this, 'actionLogin']
        ];
        return $behaviors;
    }
    public function actionLogin($username,$password)
    {
        $user = User::findByUsername($username);
        if($user!=null && $user->validatePassword($password))
        {
            return ['token' => Yii::$app->user->identity->getAuthKey()];
        }
        throw new HttpException('404', 'O username ou a password está incorreta.');

    }

}