<?php
namespace backend\controllers;

use app\models\PostotrabalhoSearch;
use common\models\Postotrabalho;
use Yii;

use common\models\Biblioteca;
use app\models\BibliotecaSearch;
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
                            'entidade',
                            'bibliotecas','bibliotecas-view','bibliotecas-create','bibliotecas-update', 'bibliotecas-delete',
                            'postos',
                            'logotipos',
                            'noticias',
                            'equipa',
                            'tipoexemplar',
                            'estexemplar',
                            'cdu',
                            'estleitor',
                            'irregularidade',
                            'cursos',
                            'recibos',
                            'resexemplar',
                            'slidesopac',
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
        return $this->render('entidade');
    }

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
            //return $this->redirect(['bibliotecas-view', 'id' => $model->id]);
            return $this->redirect($this->actionBibliotecas());
        }

        return $this->renderAjax('bibliotecas-create', ['model'=>$model]);
    }

    public function actionBibliotecasUpdate($id)
    {
        $model = $this->findModelBibliotecas($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['bibliotecas-view', 'id' => $model->id]);
            //return $this->redirect($this->actionBibliotecas())->content('modalView'.$model->id));
        }
        return $this->renderAjax('bibliotecas-update', ['model' => $model,]);
    }

    public function actionBibliotecasDelete($id)
    {
        $this->findModelBibliotecas($id)->delete();

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

        return $this->render('postos',
            ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'postoTrabalhoModels' => $postoTrabalhoModel]);
    }

    public function actionPostosView($id){
        if (($model = Postotrabalho::findOne($id)) !== null) {
            return $this->renderAjax('pto-view', ['model' => $model]);
        }

        throw new NotFoundHttpException();
    }

    public function actionPostosCreate(){
        $model = new Postotrabalho();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect($this->actionPostos());
        }

        return $this->renderAjax('pto-create', ['model'=>$model]);
    }

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
        return $this->render('estexemplar');
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

    /**
     * Gestão de Irregularidades dos Leitores homepage.
     *
     * @return string
     */
    public function actionIrregularidade()
    {
        return $this->render('irregularidade');
    }

    /**
     * Gestão dos Cursos dos Leitores homepage.
     *
     * @return string
     */
    public function actionCursos()
    {
        return $this->render('cursos');
    }
    #endregion

    #region Recibos

    /**
     * Gestão dos Recibos homepage.
     *
     * @return string
     */
    public function actionRecibos()
    {
        return $this->render('recibos');
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
        return $this->render('slidesopac');
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