<?php

namespace frontend\controllers;

use frontend\models\ObraSearch;
use Yii;
use common\models\Obra;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PesquisaController implements the CRUD actions for Obra model.
 */
class PesquisaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pesquisa models.
     * @return mixed
     */

    public function actionObra()
    {
        $model = new Obra();
        $searchModel = new ObraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // render
        return $this->render('obra', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionAvancada()
    {
        $model = new Obra();
        $searchModel = new ObraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // render
        return $this->render('avancada', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /*public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Obra::find(),
        ]);
        $obras = Obra::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'obras'=>$obras,
        ]);
    }*/

    /**
     * Finds the Pesquisa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Obra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Obra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
