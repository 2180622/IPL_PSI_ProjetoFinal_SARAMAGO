<?php

namespace backend\controllers;

use app\models\LeitorSearch;
use app\models\LeitorUpdate;
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
        $model = new LeitorCreateForm();

        $listaBibliotecas = Biblioteca::find()->all();
        $listaTiposLeitors = Tipoleitor::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', "O Leitor foi adicionado com sucesso.");
            return $this->redirect('index');
        }

        return $this->renderAjax('create', [
            'model'=>$model,
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
        $model = new LeitorUpdate($id);
        //$model = $model->findModel($id);
        /*$leitor = Leitor::findOne($id);
        $user = User::findOne($leitor->user_id);*/


        $listaBibliotecas = Biblioteca::find()->all();
        $listaTiposLeitors = Tipoleitor::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->updateLeitor()) {
            Yii::$app->session->setFlash('success', "O Leitor foi editado com sucesso.");
            return $this->redirect('index');
        }


        return $this->renderAjax('update', [
            'model' => $model,
            'listaBibliotecas'=>$listaBibliotecas,
            'listaTiposLeitors'=>$listaTiposLeitors,
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
        $leitor = $this->findModel($id);
        $user = User::findOne($leitor->user_id);
        $user->status = 9;

        $user->save();
        $leitor->delete();

        Yii::$app->session->setFlash('success', "O Leitor foi eliminado com sucesso.");
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
