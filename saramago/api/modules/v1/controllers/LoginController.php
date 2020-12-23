<?php


namespace api\modules\v1\controllers;


use common\models\User;
use yii\rest\ActiveController;

class LoginController extends ActiveController
{
    public $modelClass='common\models\User';

    public function actionLogin(){

        $this->render('site/index');

        $post=\Yii::$app->request->post();

        $user = User::findByUsername($post["username"]);
        if ($user && $user->validatePassword($post["password"]))
        {
            return ["token"=>$user->getAuthKey()];
        }
        throw new \yii\web\HttpException(404, 'O username ou password está incorreta.');
    }

    public function actionValidate_token($id,$token){
        $token = User::find()->select("verification_token")->where("id=".$id)->one();
        if($token->verification_token == $token)
        {
            $model=User::findOne($id);
            $model->status=10;
            $model->save();
        }
    }

}