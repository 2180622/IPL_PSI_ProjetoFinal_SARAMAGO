<?php

namespace api\modules\v1\controllers;

use app\models\LeitorForm;
use app\models\LeitorUpdate;
use common\models\Leitor;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class LeitorController extends ActiveController
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

    public function actionUserLeitor()
    {

    }

    public function actionCreateLeitor(){
        $leitor = new LeitorForm();

        $leitor->attributes = Yii::$app->request->post();
        $create = $leitor->save();

        return ['create' => $create];
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