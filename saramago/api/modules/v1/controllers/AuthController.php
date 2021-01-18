<?php

namespace api\modules\v1\controllers;

use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\Response;

class AuthController extends Controller
{

    public function behaviors()
    {
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    //Actions List
    public function actionIndex()
    {
        $response = [
            'POST /login' => ['username','password'],
        ];
        return $response;
    }

    public function actionLogin()
    {
        //SE ELE FIZER UM POST
        if($post=\Yii::$app->request->post())
        {
            if ((isset($post["username"]) && isset($post["password"])) != null)
            {
                $user = User::findByUsername($post["username"]);
                $nn = Yii::$app->authManager->getRoles();

                if($user->id && $user->validatePassword($post["password"]))
                {
                    if(array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0] == ("admin"||"operadorChefe"||"operadorCatalogacao"||"operadorCirculacao"))
                    {
                        return [
                            "id"=>$user->id,
                            "username"=>$user->username,
                            "token"=>$user->getAuthKey(),
                            "role"=> array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0],
                            "success"=> true,
                            "status"=>'200',
                            "saramago"=>"v".Yii::$app->version,
                        ];

                    }else
                        {
                            throw new HttpException('403', 'Você não está autorizado a realizar essa ação.');
                        }
                }
            }
            else
                {
                    throw new HttpException('406', 'O username ou a password está em falta');
                }

        throw new HttpException('401', 'O username ou a password está incorreta');
        }

        //SE FIZER POST, SEM FORM
        $response = [
            'username' => 'username',
            'password' => 'password',
        ];

        return $response;
    }

}