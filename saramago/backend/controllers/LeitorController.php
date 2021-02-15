<?php

namespace backend\controllers;

use app\models\LeitorRequisicaoSearch;
use app\models\LeitorSearch;
use app\models\LeitorUpdate;
use common\models\Biblioteca;
use common\models\Curso;
use common\models\Tipoleitor;
use common\models\User;
use backend\models\LeitorForm;
use Yii;
use common\models\Leitor;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\ForbiddenHttpException;

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
                            'view','view-full', 'create', 'update', 'delete', 'repor-password'],
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
        if ((Yii::$app->user->can('acessoLeitores'))) {
            $searchLeitor = new LeitorSearch();
            $leitores = Leitor::find()->all();
            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->select(["id, concat(nome,' (',codBiblioteca,')') as Biblioteca "])->asArray()->all(),'id','Biblioteca',['enctype' => 'multipart/form-data']);
            $dataProvider = $searchLeitor->search(Yii::$app->request->queryParams);
            $bibliotecasCount = Biblioteca::find()->count();
            $tiposLeitoresCount = Tipoleitor::find()->count();

            $this->layout = 'minor';

            return $this->render('index', [
                'searchLeitor'=>$searchLeitor,
                'leitores' => $leitores,
                'dataProvider'=>$dataProvider,
                'tiposLeitoresCount'=>$tiposLeitoresCount,
                'bibliotecasCount'=>$bibliotecasCount,
                'bibliotecaAll'=>$bibliotecaAll]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionView($id)
    {
        if ((Yii::$app->user->can('acessoLeitores'))) {
            $leitores = Leitor::find()->all();

            if (($model = Leitor::findOne($id)) !== null) {
                return $this->renderAjax('view', ['model' => $model, 'leitores'=>$leitores]);
            }

            return '<h5>Lamentamos! Ocorreu um erro com o seu pedido.</h5>';
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionViewFull($id)
    {
        if ((Yii::$app->user->can('acessoLeitores')))
        {
            $this->layout='minor';

            if (($model = Leitor::findOne($id)) !== null) {

                $user = User::findOne($model->user_id);

                $searchModelEmp = new LeitorRequisicaoSearch();
                $dataProviderEmp = $searchModelEmp->search(Yii::$app->request->queryParams);

                return $this->render('view-full', ['model' => $model, 'user' => $user,'dataProviderEmp'=>$dataProviderEmp]);
            }

            throw new NotFoundHttpException('Leitor não encontrado.');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }   


    /**
     * Creates a new Leitor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($scenario)
    {
        if ((Yii::$app->user->can('acessoLeitores'))) {
            if($scenario == 'aluno')
            {
                $model = new LeitorForm(['scenario' => LeitorForm::ALUNO]);

            }elseif($scenario == 'docente')
            {
                $model = new LeitorForm(['scenario' => LeitorForm::DOCENTE]);

            }elseif ($scenario == 'externo')
            {
                $model = new LeitorForm(['scenario' => LeitorForm::EXTERNO]);
            }

            $listaBibliotecas = Biblioteca::find()->all();
            $listaTiposLeitors = Tipoleitor::find()->all();
            $listaCursos = Curso::find()->all();

            if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }elseif ($model->load(Yii::$app->request->post()) && $id = $model->signup()) { // && $model->sendEmail()
                Yii::$app->session->setFlash('success', "O Leitor foi adicionado com sucesso.");

                return $this->redirect(['view-full', 'id' => $id]);
            }

            return $this->renderAjax('create', [
                'model'=>$model,
                'listaBibliotecas'=>$listaBibliotecas,
                'listaTiposLeitors'=>$listaTiposLeitors,
                'listaCursos' => $listaCursos,
                'scenario'=>$scenario,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('acessoLeitores'))) {
            $model = new LeitorUpdate($id);

            $listaBibliotecas = Biblioteca::find()->all();
            $listaTiposLeitors = Tipoleitor::find()->all();
            $listaCursos = Curso::find()->all();

            if ($model->load(Yii::$app->request->post()) && $model->update()) {
                Yii::$app->session->setFlash('success', "O Leitor foi editado com sucesso.");
                return $this->redirect('..');
            }


            return $this->renderAjax('update', [
                'model' => $model,
                'listaBibliotecas'=>$listaBibliotecas,
                'listaTiposLeitors'=>$listaTiposLeitors,
                'listaCursos' => $listaCursos,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionReporPassword($id){
        if ((Yii::$app->user->can('acessoLeitores'))) {
            $leitor = $this->findModel($id);
            $user = User::findOne($leitor->user_id);

            $user->setPassword($leitor->nif);

            if($user->save()){
                Yii::$app->session->setFlash('success', 'A palavra passe foi reposta com sucesso');
                return $this->redirect(['view-full', 'id' => $leitor->id]);
            }else{
                Yii::$app->session->setFlash('danger', 'Não foi possível repôr a palavra passe');
                return $this->redirect(['view-full', 'id' => $leitor->id]);
            }
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('acessoLeitores'))) {
            $leitor = $this->findModel($id);
            //$aluno = Aluno::find()->where('Leitor_id = '. $leitor->id)->one();
            $user = User::findOne($leitor->user_id);
            $user->status = 9;

            $user->save();
            //$aluno->delete();
            //$leitor->delete();

            Yii::$app->session->setFlash('success', "O Leitor foi eliminado com sucesso.");
            return $this->redirect(['index']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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

        throw new NotFoundHttpException('Leitor não encontrado.');
    }
}
