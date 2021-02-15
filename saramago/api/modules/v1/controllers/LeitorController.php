<?php

namespace api\modules\v1\controllers;

use app\models\LeitorForm;
use app\models\LeitorUpdate;
use common\models\Leitor;
use common\models\User;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\Response;

class LeitorController extends Controller
{
    public $modelClass = 'common\models\Leitor';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand(
            "SELECT leitor.id, user.username, user.auth_key, 
                    user.password_hash, user.password_reset_token, user.email, user.status,
                    user.created_at, user.updated_at, user.verification_token, user.id as user_id,
                    leitor.codBarras, leitor.nome, leitor.nif, leitor.docId, leitor.dataNasc, leitor.morada,
                    leitor.localidade, leitor.codPostal, leitor.telemovel, leitor.telefone, leitor.mail2, leitor.notaInterna,
                    leitor.dataRegisto, leitor.dataAtualizado,
                    leitor.Biblioteca_id, leitor.TipoLeitor_id
                FROM leitor INNER JOIN user ON user.id = leitor.user_id
                WHERE user.status = 10");
        $leitor = $command->queryAll();
        return $leitor;


    }

    public function actionView($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand(
            'SELECT leitor.id, user.username, user.auth_key, 
                    user.password_hash, user.password_reset_token, user.email, user.status,
                    user.created_at, user.updated_at, user.verification_token, user.id as user_id,
                    leitor.codBarras, leitor.nome, leitor.nif, leitor.docId, leitor.dataNasc, leitor.morada,
                    leitor.localidade, leitor.codPostal, leitor.telemovel, leitor.telefone, leitor.mail2, leitor.notaInterna,
                    leitor.dataRegisto, leitor.dataAtualizado,
                    leitor.Biblioteca_id, leitor.TipoLeitor_id
                FROM leitor INNER JOIN user ON user.id = leitor.user_id
                WHERE leitor.id ='.$id.' AND user.status = 10');
        $leitor = $command->queryAll();
        return $leitor;
    }

    public function actionCreate()
    {
        $model = new LeitorForm();
        $model->attributes = Yii::$app->request->post();
        if ($mCreate = $model->signup())
        {
            $user = User::findOne($mCreate->user_id);

            return [
                $mCreate,
                $user->email,
                $user->username,
                "success"=> true,
                "status"=>200,
            ];

        } else {
            return $errors = $model->errors;
        }
    }

    public function actionUpdate($id)
    {
        if($leitor = Leitor::findOne($id))
        {
            $model = new LeitorUpdate($id);
            $model->attributes = Yii::$app->request->post();

            if ($mUpdate = $model->update())
            {
                $user = User::findOne($mUpdate->user_id);
                return [
                    $mUpdate,
                    "email"=>$user->email,
                    "username"=> $user->username,
                    "success"=> true,
                    "status"=>200,
                ];

            } else {
                return $errors = $model->errors;
            }
        }

        throw new HttpException('404', 'Leitor não encontrado!');
    }

    public function actionDelete($id){

        if($leitor = Leitor::findOne($id))
        {
            $user = User::findOne($leitor->user_id);

            $user->status = 9;
            $user->save();

            return [
            "message"=>"Leitor Apagado!",
            "success"=> true,
            "status"=>200,
            ];
        }
        throw new HttpException('404', 'Leitor não encontrado!');
    }

    public function actionTotal(){
        $model = new $this->modelClass;
        $leitores = $model::find()->all();

        return ['total' => count($leitores)];
    }
}