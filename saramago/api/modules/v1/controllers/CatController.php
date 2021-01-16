<?php
namespace api\modules\v1\controllers;

use app\models\ObraForm;
use common\models\Obra;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class CatController extends Controller
{
    public $modelClassObra = 'common\models\Obra';
    public $modelClassAutor = 'common\models\Autor';
    /**
     * {@inheritdoc}
     */
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

    public function actionObra(){
        $model = new $this->modelClassObra;
        $obras = $model::find()->all();

        return $obras;
    }

    public function actionObratotal(){
        $model = new $this->modelClassObra;
        $obras_count = $model::find()->all();

        return count($obras_count);
    }

    public function actionObracreate(){ //FIXME
        $obra = new ObraForm();

        $obra->attributes = Yii::$app->request->post();
        $create = $obra->save();

        return ['create' => $create];
    }

    public function actionUpdateObra($id){ //FIXME
        $obra = Obra::findOne($id);
        $obra->attributes=Yii::$app->request->post();

        $update = $obra->save();

        return $update;
    }

    public function actionDeleteObra($id){ //FIXME

        $obra = Obra::findOne($id);
        $obra->attributes=Yii::$app->request->post();

        $delete = $obra->delete();

        return $delete;
    }


}