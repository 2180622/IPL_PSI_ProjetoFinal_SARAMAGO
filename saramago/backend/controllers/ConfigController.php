<?php
namespace backend\controllers;

use Yii;

use app\models\CursoSearch;
use app\models\EntidadeSearch;
use app\models\BibliotecaSearch;
use app\models\PostotrabalhoSearch;
use common\models\Biblioteca;
use common\models\Config;
use common\models\Curso;
use common\models\Estatutoexemplar;
use common\models\Postotrabalho;
use common\models\Tipoirregularidade;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ConfigController extends Controller
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
                            'entidade', 'entidade-update',
                            'bibliotecas','bibliotecas-view','bibliotecas-create','bibliotecas-update', 'bibliotecas-delete',
                            'postos', 'postos-view', 'postos-create', 'postos-update', 'postos-delete',
                            'logotipos',
                            'noticias',
                            'equipa',
                            'tipoexemplar',
                            'estexemplar','estexemplar-update',
                            'cdu',
                            'estleitor',
                            'irregularidades','irregularidades-update',
                            'cursos','cursos-view','cursos-create','cursos-update','cursos-delete',
                            'recibos','recibos-update',
                            'resexemplar',
                            'slidesopac','slidesopac-update',
                            'arrumacao'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'bibliotecasview'=>['GET'],
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
        return $this->render('index');
    }

    #region Entidade

    /**
     * Dados da entidade homepage.
     *
     * @return string
     */
    public function actionEntidade()
    {
        $searchModel = new EntidadeSearch();
        $entidadeModel = Config::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('entidade', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'entidadeModels' => $entidadeModel]);
    }

    public function actionEntidadeUpdate($id)
    {
        $model = $this->findModelEntidade($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "O estado para definição selecionada foi alterada.");
            return $this->redirect(['entidade']);
        }
        return $this->renderAjax('entidade-update', ['model' => $model]);
    }

    protected function findModelEntidade($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

    #region Bibliotecas
    /**
     * Bibliotecas da entidade homepage.
     *
     * @return string
     */
    public function actionBibliotecas()
    {
        $searchModel = new BibliotecaSearch();
        $bibliotecasModel = Biblioteca::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bibliotecas', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'bibliotecasModels' => $bibliotecasModel]);
    }

    public function actionBibliotecasView($id)
    {
        if (($model = Biblioteca::findOne($id)) !== null) {
            return $this->renderAjax('bibliotecas-view', ['model' => $model]);
        }

        throw new NotFoundHttpException();
    }

    public function actionBibliotecasCreate()
    {
        $model = new Biblioteca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Foi adicionada uma nova biblioteca.");
            return $this->redirect('bibliotecas');
        }

        return $this->renderAjax('bibliotecas-create', ['model'=>$model]);
    }

    public function actionBibliotecasUpdate($id)
    {
        $model = $this->findModelBibliotecas($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "A biblioteca foi atualizada.");
            return $this->redirect('bibliotecas');
        }
        return $this->renderAjax('bibliotecas-update', ['model' => $model,]);
    }

    public function actionBibliotecasDelete($id)
    {
        $this->findModelBibliotecas($id)->delete();
        Yii::$app->session->setFlash('success', "A biblioteca foi eliminada.");
        return $this->redirect(['bibliotecas']);
    }

    protected function findModelBibliotecas($id)
    {
        if (($model = Biblioteca::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

    #region Postos de Trabalho
    /**
     * Postos de Trabalho das bibliotecas homepage.
     *
     * @return string
     */
    public function actionPostos()
    {
        $searchModel = new PostotrabalhoSearch();
        $postoTrabalhoModel = Postotrabalho::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('postos',['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'postoTrabalhoModels' => $postoTrabalhoModel]);
    }

    public function actionPostosView($id){
        if (($model = Postotrabalho::findOne($id)) !== null) {
            return $this->renderAjax('postos-view', ['model' => $model]);
        }

        return 1;
    }

    public function actionPostosCreate(){
        $model = new Postotrabalho();
        new Biblioteca();
        $listaBibliotecas = Biblioteca::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "O posto de trabalho foi adicionado.");
            return $this->redirect('postos');
        }

        return $this->renderAjax('postos-create', ['model'=>$model, 'listaBibliotecas'=>$listaBibliotecas]);
    }
    public function actionPostosUpdate($id)
    {
        $model = $this->findModelPostostrabalho($id);
        new Biblioteca();
        $listaBibliotecas = Biblioteca::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "O posto de trabalho foi atualizado.");
            return $this->redirect('postos');
        }
        return $this->renderAjax('postos-update', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]);
    }

    public function actionPostosDelete($id)
    {
        $this->findModelPostostrabalho($id)->delete();

        Yii::$app->session->setFlash('success', "O posto de trabalho foi eliminado.");

        return $this->redirect(['postos']);
    }

    protected function findModelPostostrabalho($id)
    {
        if (($model = Postotrabalho::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();

    }

    #endregion
    /**
     * Gestão dos logótipos homepage.
     *
     * @return string
     */
    public function actionLogotipos()
    {
        return $this->render('logotipos');
    }

    /**
     * Gestão de Noticías homepage.
     *
     * @return string
     */
    public function actionNoticias()
    {
        return $this->render('noticias');
    }

    #endregion

    #region Gestão da Equipa

    /**
     * Gestão da equipa do SARAMAGO homepage.
     *
     * @return string
     */
    public function actionEquipa()
    {
        return $this->render('equipa');
    }

    #endregion

    #region Catálogo

    /**
     * Gestão dos tipos de exemplares homepage.
     *
     * @return string
     */
    public function actionTipoexemplar()
    {
        return $this->render('tipoexemplar');
    }

    /**
     * Gestão dos estatutos de empréstimo de cada tipo obra homepage.
     *
     * @return string
     */
    public function actionEstexemplar()
    {
        $estExemplarModels = Estatutoexemplar::find()->all();
        $dataProvider = new ActiveDataProvider(['query' => EstatutoExemplar::find()]);

        return $this->render('estexemplar', ['dataProvider' => $dataProvider, 'estExemplarModels' => $estExemplarModels]);
    }

    public function actionEstexemplarUpdate($id)
    {
        $model = $this->findModelEstexemplar($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('estexemplar');
        }

        return $this->renderAjax('estexemplar-update', ['model' => $model,]);
    }

    protected function findModelEstexemplar($id)
    {
        if (($model = EstatutoExemplar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Gestão da Código Decimal Universal homepage.
     *
     * @return string
     */
    public function actionCdu()
    {
        return $this->render('cdu');
    }

    #endregion

    #region Leitores

    /**
     * Gestão dos Estatutos dos Leitores homepage.
     *
     * @return string
     */
    public function actionEstleitor()
    {
        return $this->render('estleitor');
    }

    #region Irregularidades
    /**
     * Gestão de Irregularidades dos Leitores homepage.
     *
     * @return string
     */
    public function actionIrregularidades()
    {
        $dataProvider = new ActiveDataProvider(['query' => Tipoirregularidade::find()]);
        $irregularidadesModels = Tipoirregularidade::find()->all();

        return $this->render('irregularidades', ['dataProvider' => $dataProvider, 'irregularidadesModels'=>$irregularidadesModels]);
    }

    public function actionIrregularidadesUpdate($id)
    {
        $model = $this->findModelIrregularidades($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "A irregularidade para o tipo de obra foi atualizada.");
            return $this->redirect('irregularidades');
        }

        return $this->renderAjax('irregularidades-update', ['model' => $model,]);
    }

    protected function findModelIrregularidades($id)
    {
        if (($model = Tipoirregularidade::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

    #region Cursos
    /**
     * Gestão dos Cursos dos Leitores homepage.
     *
     * @return string
     */
    public function actionCursos()
    {
        $cursosModels = Curso::find()->all();

        $searchModel = new CursoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('cursos/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'cursosModels'=>$cursosModels]);
    }

    public function actionCursosView($id)
    {
        return $this->renderAjax('cursos/view', ['model' => $this->findModelCursos($id)]);
    }

    public function actionCursosCreate()
    {
        $model = new Curso();
        $searchModel = new CursoSearch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$model->nome." foi adicionado com sucesso.");

            $endPage = $searchModel->search(Yii::$app->request->queryParams)->pagination->getLimit();

            return $this->redirect(['cursos', 'page'=>$endPage]);
        }

        return $this->renderAjax('cursos/create', ['model' => $model,]);
    }

    public function actionCursosUpdate($id){

        $model = $this->findModelCursos($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$model->nome." foi atualizado com sucesso.");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax('cursos/update', ['model' => $model,]);
    }

    public function actionCursosDelete($id)
    {
        $oldCurso=$this->findModelCursos($id)->nome;

        $this->findModelCursos($id)->delete();
        Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$oldCurso." foi apagado.");

        return $this->redirect(Yii::$app->request->referrer);
    }

    protected function findModelCursos($id)
    {
        if (($model = curso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }
    #endregion

    #endregion

    #region Recibos

    /**
     * Gestão dos Recibos homepage.
     *
     * @return string
     */
    public function actionRecibos()
    {
        $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', "recibo_"])]);
        $recibosModel = Config::find()->all();

        return $this->render('recibos', ['dataProvider' => $dataProvider, 'recibosModel'=> $recibosModel]);

    }

    public function actionRecibosUpdate($id)
    {
        $model = $this->findModelRecibos($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "O estado para definição selecionada foi alterada.");
            return $this->redirect('recibos');
        }

        return $this->renderAjax('recibos-update', ['model' => $model,]);
    }

    protected function findModelRecibos($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

    #region OPAC
    /**
     * Gestão das Reservas dos Exemplares (OPAC) homepage.
     *
     * @return string
     */
    public function actionResexemplar()
    {
        return $this->render('resexemplar');
    }

    /**
     * Gestão da Últimas Obras Adquiridas (OPAC) homepage.
     *
     * @return string
     */
    public function actionSlidesopac()
    {
        $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', "opac_obrasAdquiridas"])]);
        $slidesopacModel = Config::find()->all();

        return $this->render('slidesopac', ['dataProvider' => $dataProvider, 'slidesopacModels'=> $slidesopacModel]);

    }

    public function actionSlidesopacUpdate($id)
    {
        $model = $this->findModelSlidesopac($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "O estado para definição selecionada foi alterada.");
            return $this->redirect('slidesopac');
        }

        return $this->renderAjax('slidesopac-update', ['model' => $model,]);
    }

    protected function findModelSlidesopac($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

    #region Aplicação Móvel
    /**
     * Gestão da funcionalidade "arrumar" homepage.
     *
     * @return string
     */
    public function actionArrumacao()
    {
        return $this->render('arrumacao');
    }
    #endregion

}