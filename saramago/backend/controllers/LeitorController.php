<?php

namespace backend\controllers;

use app\models\LeitorSearch;
use common\models\Biblioteca;
use common\models\Tipoleitor;
use common\models\User;
use backend\models\LeitorCreateForm;
use Yii;
use common\models\Leitor;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeitorController implements the CRUD actions for Leitor model.
 */
class LeitorController extends Controller
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
                        'actions' => ['logout', 'index',
                            'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Leitor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchLeitor = new LeitorSearch();
        $leitores = Leitor::find()->all();
        $dataProvider = $searchLeitor->search(Yii::$app->request->queryParams);

        $this->layout = 'minor';

        return $this->render('index', [
            'searchLeitor'=>$searchLeitor,
            'leitores' => $leitores,
            'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * Displays a single Leitor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $leitores = Leitor::find()->all();

        if (($model = Leitor::findOne($id)) !== null) {
            return $this->renderAjax('view', ['model' => $model, 'leitores'=>$leitores]);
        }

        return 1;
    }

    /**
     * Creates a new Leitor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelSignUp = new LeitorCreateForm();

        $listaBibliotecas = Biblioteca::find()->all();
        $listaTiposLeitors = Tipoleitor::find()->all();

        if ($modelSignUp->load(Yii::$app->request->post()) && $modelSignUp->signup()) {
            return $this->goHome();
        }

        return $this->renderAjax('create', [
            'modelSignUp'=>$modelSignUp,
            'listaBibliotecas'=>$listaBibliotecas,
            'listaTiposLeitors'=>$listaTiposLeitors,
        ]);
    }

    /**
     * Updates an existing Leitor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Leitor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Leitor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leitor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
