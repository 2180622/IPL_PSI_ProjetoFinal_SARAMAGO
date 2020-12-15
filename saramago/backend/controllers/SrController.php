<?php
namespace backend\controllers;

use app\models\ReprografiaSearch;
use common\models\Reprografia;
use common\models\ReprografiaQuery;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SrController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout="minor";

        $searchServicosReprograficos = new ReprografiaSearch();
        $servicosReprograficos = Reprografia::find()->all();
        $dataProvider = $searchServicosReprograficos->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'servicosReprograficos' => $servicosReprograficos,
            'searchServicosReprograficos' => $searchServicosReprograficos,
            'dataProvider' => $dataProvider]);
    }
}