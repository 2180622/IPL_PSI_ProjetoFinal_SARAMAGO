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
use yii\web\HttpException;
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

    public function actionObra(){
        $model = new $this->modelClassObra;
        $obras = $model::find()->all();

        return $obras;
    }

    public function actionObraTotal()
    {
        $model = new $this->modelClassObra;
        $obras_count = $model::find()->all();

        return count($obras_count);
    }

    public function actionObraCreate()
    {
        $model = new ObraForm();
        $model->attributes = Yii::$app->request->post();
        if ($mCreate = $model->create())
        {
            return $mCreate;

        } else {
            return $errors = $model->errors;
        }

    }

    public function actionObraUpdate($id)
    {
        if($model = Obra::findOne($id))
        {
            $model = Obra::findOne($id);
            $model->attributes = Yii::$app->request->post();

            if($mUpdate = $model->update())
            {
                return ["success"=> true, "status"=>200];

            }else
                {
                return $errors = $model->errors;
            }
        }

        throw new HttpException('404', "Obra não encontrada.");
    }

    public function actionObraDelete($id)
    {
        if($obra = Obra::findOne($id))
        {
            $delete = $obra->delete();

            return $delete;

        }
        throw new HttpException('404', "Obra não encontrada.");
    }

}