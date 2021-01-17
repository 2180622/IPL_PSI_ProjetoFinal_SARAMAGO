<?php

namespace api\modules\v1\controllers;

use app\models\LeitorForm;
use app\models\LeitorUpdate;
use common\models\Leitor;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\HttpException;
use yii\web\Response;

class LeitorController extends Controller
{
    public $modelClass = 'common\models\Leitor';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        /*$behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];*/
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
        $leitor = Leitor::find()
            ->select('*')
            ->join("left join","user as user","user.id = user_id")
            ->asArray()
            ->all();

        return $leitor;
    }

    public function actionCreate()
    {
        $model = new LeitorForm();

        $model->attributes = Yii::$app->request->post();
        if($model->load(Yii::$app->request->post()) && $model->signup())
        {
            return $model;
        }
        else
        {
            $model->getErrors();
        }

        /*$leitor = new LeitorForm();
        if($leitor->load(Yii::$app->getRequest()->getBodyParams(), '') && $leitor->validate() && $leitor->load(Yii::$app->request->post())){
            //$leitor->attributes = Yii::$app->request->post();
            $create = $leitor->signup();

            return ['create' => $create];
        }
        throw new HttpException('400');*/
    }

    public function actionTotal(){
        $model = new $this->modelClass;
        $leitores = $model::find()->all();

        return ['total' => count($leitores)];
    }

    public function actionUpdateLeitor($id){
        $leitor = Leitor::findOne($id);
        $leitor->attributes=Yii::$app->request->post();

        $update = $leitor->save();

        return $update;
    }

    public function actionDeleteLeitor($id){

        $leitor = Leitor::findOne($id);
        $leitor->attributes=Yii::$app->request->post();

        $delete = $leitor->delete();

        return $delete;
    }
}