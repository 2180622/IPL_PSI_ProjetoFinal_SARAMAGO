<?php

namespace frontend\controllers;

use Yii;
use app\models\ExemplarSearch;
use common\models\ReservaSearch;
use common\models\ReservaspostoSearch;
use common\models\Biblioteca;
use common\models\Tipoexemplar;
use common\models\Exemplar;
use common\models\Reserva;
use common\models\ReservasPosto;
use common\models\PostoTrabalho;
use common\models\Obra;
use common\models\Leitor;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ReservaController implements the CRUD actions for Reserva model.
 */
class ReservaController extends Controller
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
                            'posto', 'posto-create', 'posto-update', 'posto-delete', 'posto-view',
                            'exemplar', 'exemplar-create', 'exemplar-update', 'exemplar-delete', 'exemplar-view', 'exemplar-reserva',
                            'obra-full',
                        ],
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

    public function actionObraFull($id) {
        if ((Yii::$app->user->can('acessoFrontend'))) {

            $tipoExemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);

            $searchModelExemplar = new ExemplarSearch();
            $dataProviderExemplar = $searchModelExemplar->search(Yii::$app->request->queryParams);

            return $this->render('obra-full', [
                'model' => $this->findObraModel($id),
                'dataProviderExemplar' => $dataProviderExemplar, 'searchModelExemplar' => $searchModelExemplar,
                'tipoExemplarAll' => $tipoExemplarAll,
                'bibliotecaAll' => $bibliotecaAll,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }

    public function actionExemplarReserva($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $model = new Reserva();

            $idDoUserLoggado = Yii::$app->user->id;
            $idDoLeitor = Leitor::find()->where(['user_id' => $idDoUserLoggado])->one();

            if ($idDoLeitor === null) {
                throw new ForbiddenHttpException ('Esta área serve para apenas os leitores Saramago efetuarem reservas');
            }

            $model->Leitor_id = $idDoLeitor->id;
            $model->Exemplar_id = $id;

            var_dump($model->load(Yii::$app->request->post())); die();
            if ($model->load(Yii::$app->request->post()) && $model->save() && $model->validate()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A reserva da obra "'.$model->exemplar->obra->titulo.'" foi adicionada com sucesso.');
                return $this->redirect(['obra-full', 'id' => $model->exemplar->obra->id]);
            }

            return $this->redirect(['obra-full', 'id' => $model->exemplar->obra->id]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }


    /**
     * Lists all Reserva models.
     * @return mixed
     */
    public function actionPosto()
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {

            $idDoUserLoggado = Yii::$app->user->id;
            $idDoLeitor = Leitor::find()->where(['user_id' => $idDoUserLoggado])->one();

            if ($idDoLeitor === null) {
                throw new ForbiddenHttpException ('Esta área serve para apenas os leitores Saramago efetuarem reservas');
            }

            $reservasPosto = ReservasPosto::find()->where(['Leitor_id' => $idDoLeitor->id])->all();
            
            $reservasPostoSearchModel = new ReservaspostoSearch();
            $dataProvider = $reservasPostoSearchModel->search(Yii::$app->request->queryParams);

            $postoTrabalhoAll = ArrayHelper::map(PostoTrabalho::find()->all(),'id','designacao',['enctype' => 'multipart/form-data']);

            return $this->render('posto', [
                'dataProvider' => $dataProvider,
                'reservasPosto' => $reservasPosto,
                'reservasPostoSearchModel' => $reservasPostoSearchModel,
                'postoTrabalhoAll' => $postoTrabalhoAll, 
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    public function actionExemplar()
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {

            $idDoUserLoggado = Yii::$app->user->id;
            $idDoLeitor = Leitor::find()->where(['user_id' => $idDoUserLoggado])->one();

            if ($idDoLeitor === null) {
                throw new ForbiddenHttpException ('Esta área serve para apenas os leitores Saramago efetuarem reservas');
            }

            $reservasExemplar = Reserva::find()->where(['Leitor_id' => $idDoLeitor->id])->all();
            
            $reservaSearchModel = new ReservaSearch();
            $dataProvider = $reservaSearchModel->search(Yii::$app->request->queryParams);

            

            return $this->render('exemplar', [
                'dataProvider' => $dataProvider,
                'reservaSearchModel' => $reservaSearchModel,
                'reservasExemplar'=>$reservasExemplar,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }


    /**
     * Displays a single Reserva model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPostoView($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            return $this->renderAjax('postoview', [
                'model' => $this->findPostoModel($id),
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }


    public function actionExemplarView($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            return $this->renderAjax('exemplarview', [
                'model' => $this->findExemplarModel($id),
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    /**
     * Creates a new Reserva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    public function actionPostoCreate()
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $model = new ReservasPosto();

            $idDoUserLoggado = Yii::$app->user->id;
            $idDoLeitor = Leitor::find()->where(['user_id' => $idDoUserLoggado])->one();

            if ($idDoLeitor === null) {
                throw new ForbiddenHttpException ('Esta área serve para apenas os leitores Saramago efetuarem reservas');
            }

            $postoTrabalhoAll = ArrayHelper::map(PostoTrabalho::find()->all(),'id','designacao',['enctype' => 'multipart/form-data']);
            $model->load(Yii::$app->request->post());
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('postocreate', [
                'model' => $model, 'postoTrabalhoAll' => $postoTrabalhoAll, 'idDoLeitor' => $idDoLeitor
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }


    public function actionExemplarCreate()
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $model = new Reserva();

  // TODO RUI RECOMEÇAR AQUI
           // $exemplarDaObraAll = ArrayHelper::map(Reserva::find()->all(),'id','designacao',['enctype' => 'multipart/form-data']);
           //) var_dump($exemplarDaObraAll);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['reserva']);
            }

            return $this->render('exemplarcreate', [
                'model' => $model,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    /**
     * Updates an existing Reserva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPostoUpdate($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $model = $this->findPostoModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['posto-view', 'id' => $model->id]);
            }

            return $this->render('postoupdate', [
                'model' => $model,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    public function actionExemplarUpdate($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $model = $this->findExemplarModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['exemplarview', 'id' => $model->id]);
            }

            return $this->render('exemplarupdate', [
                'model' => $model,
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    /**
     * Deletes an existing Reserva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPostoDelete($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $this->findPostoModel($id)->delete();

            return $this->redirect(['posto']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    public function actionExemplarDelete($id)
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {
            $this->findExemplarModel($id)->delete();

            return $this->redirect(['exemplar']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');  
    }

    /**
     * Finds the Reserva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reserva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findPostoModel($id)
    {
        if (($model = PostoTrabalho::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findExemplarModel($id)
    {
        if (($model = Reserva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findObraModel ($id)
    {
        if (($model = Obra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A obra que tentou aceder encontra-se indisponível');
    }
}
