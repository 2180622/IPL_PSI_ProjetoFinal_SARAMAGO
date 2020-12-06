<?php
namespace backend\controllers;

use backend\models\EquipaSearch;
use common\models\AuthAssignment;
use Yii;

use backend\models\FuncionarioCreateForm;
use app\models\BibliotecaSearch;
use app\models\CursoSearch;
use app\models\LogotiposForm;
use app\models\PostotrabalhoSearch;
use app\models\TipoLeitorSearch;
use common\models\Funcionario;
use common\models\Tipoleitor;
use common\models\User;
use common\models\Biblioteca;
use common\models\Config;
use common\models\Curso;
use common\models\Entidade;
use common\models\Estatutoexemplar;
use common\models\Leitor;
use common\models\Postotrabalho;
use common\models\Tipoirregularidade;
use common\models\Tipoexemplar;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                        'actions' => ['logout', 'index','conta',
                            'entidade', 'entidade-update','entidade-reset',
                            'bibliotecas','bibliotecas-view','bibliotecas-create','bibliotecas-update', 'bibliotecas-delete',
                            'postos', 'postos-view', 'postos-create', 'postos-update', 'postos-delete',
                            'logotipos','logotipos-view','logotipos-update','logotipos-reset',
                            'noticias',
                            'equipa', 'equipa-view', 'equipa-associate', 'equipa-create', 'equipa-update', 'equipa-delete',
                            'tipoexemplar', 'tipoexemplar-view', 'tipoexemplar-create', 'tipoexemplar-update', 'tipoexemplar-delete',
                            'estexemplar','estexemplar-update','estexemplar-reset',
                            'cdu',
                            'estleitor','estleitor-view','estleitor-create','estleitor-update','estleitor-delete',
                            'irregularidades','irregularidades-update',
                            'cursos','cursos-view','cursos-create','cursos-update','cursos-delete',
                            'recibos','recibos-update',
                            'resexemplar', 'resexemplar-update',
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
        $user = Yii::$app->user;
        $leitor = Leitor::find()->where(['user_id' => $user->id])->one();

        if($leitor!=null)
        {
            $identity = $leitor->nome;
        }else{
            $identity = '@' . $user->identity->username . '';
        }
        return $this->render('index', ['identity'=>$identity]);
    }

    #region Conta
    public function actionConta()
    {
        return $this->render('conta/index');
    }
    #endregion

    #region Entidade

    /**
     * Dados da entidade homepage.
     *
     * @return string
     */
    public function actionEntidade()
    {
        $searchModel = new Entidade();
        $entidadeModel = Config::find()->all();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('entidade/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'entidadeModels' => $entidadeModel]);
    }

    public function actionEntidadeUpdate($id)
    {
        $model = $this->findModelEntidade($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> " . $model->info. " foi alterado.");
            return $this->redirect(['entidade']);
        }
        return $this->renderAjax('entidade/update', ['model' => $model]);
    }

    public function actionEntidadeReset($id)
    {
        $model = $this->findModelEntidade($id);
        $model->reset($id);
        Yii::$app->session->setFlash('success', "<strong>Informação:</strong> " . $model->info. " foi reposto.");

        return $this->redirect(['entidade/index']);
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

        return $this->render('bibliotecas/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'bibliotecasModels' => $bibliotecasModel]);
    }

    public function actionBibliotecasView($id)
    {
        if (($model = Biblioteca::findOne($id)) !== null) {
            return $this->renderAjax('bibliotecas/view', ['model' => $model]);
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

        return $this->renderAjax('bibliotecas/create', ['model'=>$model]);
    }

    public function actionBibliotecasUpdate($id)
    {
        $model = $this->findModelBibliotecas($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "A biblioteca foi atualizada.");
            return $this->redirect('bibliotecas');
        }
        return $this->renderAjax('bibliotecas/update', ['model' => $model,]);
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

        return $this->render('postos/index',['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'postoTrabalhoModels' => $postoTrabalhoModel]);
    }

    public function actionPostosView($id){

        //FIXME
        if (($model = Postotrabalho::findOne($id)) !== null) {
            return $this->renderAjax('postos/view', ['model' => $model]);
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

        return $this->renderAjax('postos/create', ['model'=>$model, 'listaBibliotecas'=>$listaBibliotecas]);
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
        return $this->renderAjax('postos/update', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]);
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

    #region Logotipos
    /**
     * Gestão dos logótipos homepage.
     *
     * @return string
     */
    public function actionLogotipos()
    {
        $logotiposModels = Config::find()->where(['like', 'key', 'logotipo'])->orWhere(['like', 'key', 'favicon'])->all();
        $dataProvider = new ActiveDataProvider(
            ['query' => Config::find()->where(['like', 'key', 'logotipo'])->orWhere(['like', 'key', 'favicon'])]
        );

        return $this->render('logotipos/index', ['dataProvider' => $dataProvider, 'logotiposModels'=>$logotiposModels]);

    }
    public function actionLogotiposView($id)
    {

        return $this->renderAjax('logotipos/view', ['model' => $this->findModelLogotipos($id)]);

    }

    public function actionLogotiposUpdate($id)
    {
        $model = $this->findModelLogotipos($id);

        if(Yii::$app->request->isPost)
        {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->upload($id)) {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O " . $model->info. " foi adicionado.");
                return $this->redirect('logotipos');;
            }
        }
        return $this->renderAjax('logotipos/update', ['model' => $model,]);
    }

    public function actionLogotiposReset($id)
    {
        $model = $this->findModelLogotipos($id);
        $model->reset($id);
        Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O " . $model->info. " foi reposto.");

        return $this->redirect(['config/logotipos']);
    }


    protected function findModelLogotipos($id)
    {
        if (($model = LogotiposForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

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
        $operadores = User::find()->leftJoin(AuthAssignment::tableName(), "user_id = id")->where("item_name LIKE '%operador%'")->all();
        $operadorCount = User::find()->leftJoin(AuthAssignment::tableName(), "user_id = id")->where("item_name LIKE '%operador%'")->count();
        $searchModel = new EquipaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('equipa/index',
            ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                'operadores' => $operadores, 'operadorCount' => $operadorCount]);
    }

    public function actionEquipaView($id){

        //TODO APAGAR
        if (($model = Funcionario::findOne($id)) !== null) {
            $leitor = Leitor::findOne($model->Leitor_id);
            $user = User::findOne($model->leitor->user_id);

            return $this->renderAjax('equipa/view', [
                'model' => $model,
                'leitor'=>$leitor,
                'user'=>$user]);
        }

        throw new NotFoundHttpException();
    }

    public function actionEquipaCreate(){

        //TODO APAGAR

        $model = new FuncionarioCreateForm();
        $listaBibliotecas = Biblioteca::find()->all();
        $listaTiposLeitors = Tipoleitor::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->createFuncionario()) {
            Yii::$app->session->setFlash('success', "O Funcionário foi criado com sucesso");
            return $this->redirect('equipa');
        }

        return $this->renderAjax('equipa/create', [
            'model'=>$model,
            'listaBibliotecas'=>$listaBibliotecas,
            'listaTiposLeitors'=>$listaTiposLeitors]);
    }

    public function actionEquipaAssociate()
    {
        //FIXME
        $model = new FuncionarioCreateForm();
        $leitores = Leitor::find()->all();
        $funcionarios = Funcionario::find()->all();


        if($leitores == null){
            Yii::$app->session->setFlash('error', "Não existem Leitores possíveis para associar");
            return $this->redirect('equipa');
        }else if($model->associateFuncionario() == false) {
            Yii::$app->session->setFlash('error', "Houve um erro.");
            return $this->redirect('equipa');
        }else if($model->load(Yii::$app->request->post()) && $model->associateFuncionario()) {
            Yii::$app->session->setFlash('success', "O Funcionário foi adicionado.");
            return $this->redirect('equipa');
        }

        return $this->renderAjax('equipa/associate', [
            'model'=>$model,
            'leitores'=>$leitores]);
    }

    public function actionEquipaUpdate($id){
        //FIXME
        $model = new FuncionarioCreateForm();
        $funcionario = Funcionario::findOne($id);
        $leitor = Leitor::findOne($funcionario->Leitor_id);
        $user = User::findOne($leitor->user_id);
        $listaBibliotecas = Biblioteca::find()->all();
        $listaTiposLeitors = Tipoleitor::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->updateFuncionario($id)) {

            Yii::$app->session->setFlash('success', "O Funcionário foi atualizado.");
            return $this->redirect('equipa');
        }

        return $this->renderAjax('equipa/update', [
            'model' => $model,
            'funcionario'=>$funcionario,
            'leitor'=>$leitor,
            'user'=>$user,
            'listaBibliotecas' => $listaBibliotecas,
            'listaTiposLeitors' => $listaTiposLeitors]);
    }

    public function actionEquipaDelete($id){
        $funcionario = $this->findModelEquipa($id);
        $leitor = Leitor::findOne($funcionario->Leitor_id);
        $user = User::findOne($leitor->user_id);
        $user->status = 9;

        $user->save();
        $funcionario->delete();
        $leitor->delete();

        return $this->redirect('equipa');
    }

    public function findModelEquipa($id){
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
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
        $tipoexemplarModels = Tipoexemplar::find()->all();
        $dataProvider = new ActiveDataProvider(['query' => Tipoexemplar::find()]);

        return $this->render('tipoexemplar/index', ['dataProvider' => $dataProvider, 'tipoexemplarModels' => $tipoexemplarModels]);
    }

    public function actionTipoexemplarView($id)
    {
        if (($model = Tipoexemplar::findOne($id)) !== null) {
            return $this->renderAjax('tipoexemplar/view', ['model' => $model]);
        }

        throw new NotFoundHttpException();
    }

    public function actionTipoexemplarCreate()
    {
        $model = new Tipoexemplar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Foi adicionada um novo tipo de exemplar.");
            return $this->redirect('tipoexemplar');
        }

        return $this->renderAjax('tipoexemplar/create', ['model' => $model]);
    }

    public function actionTipoexemplarUpdate($id)
    {
        $model = $this->findModelTipoexemplar($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O tipo de exemplar "' . $model->designacao . '" foi atualizado.');
            return $this->redirect('tipoexemplar');
        }

        return $this->renderAjax('tipoexemplar/update', ['model' => $model,]);
    }

    

    public function actionTipoexemplarReset($id)
    {
        $model = $this->findModelTipoexemplar($id);
        $model->reset($id);
        Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O tipo de exemplar "' . $model->designacao . '" foi reposto.');

        return $this->redirect(['tipoexemplar']);
    }

    protected function findModelTipoexemplar($id)
    {
        if (($model = Tipoexemplar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    #endregion

    #region Estatutos dos Exemplares

    /**
     * Gestão dos estatutos de empréstimo de cada tipo obra homepage.
     *
     * @return string
     */
    public function actionEstexemplar()
    {
        $estExemplarModels = Estatutoexemplar::find()->all();
        $dataProvider = new ActiveDataProvider(['query' => EstatutoExemplar::find()]);

        return $this->render('estexemplar/index', ['dataProvider' => $dataProvider, 'estExemplarModels' => $estExemplarModels]);
    }

    public function actionEstexemplarUpdate($id)
    {
        $model = $this->findModelEstexemplar($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "' . $model->estatuto . '" foi atualizado.');
            return $this->redirect('estexemplar');
        }

        return $this->renderAjax('estexemplar/update', ['model' => $model,]);
    }

    public function actionEstexemplarReset($id)
    {
        $model = $this->findModelEstexemplar($id);
        $model->reset($id);
        Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "' . $model->estatuto. '" foi reposto.');

        return $this->redirect(['estexemplar']);
    }

    protected function findModelEstexemplar($id)
    {
        if (($model = EstatutoExemplar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    #endregion

    #region CDU
    /**
     * Gestão da Código Decimal Universal homepage.
     *
     * @return string
     */
    public function actionCdu()
    {
        return $this->render('cdu/index');
    }
    #endregion

    #endregion

    #region Leitores

    #region Estatuto do Leitor

    /**
     * Gestão dos Estatutos dos Leitores homepage.
     *
     * @return string
     */
    public function actionEstleitor()
    {
        $searchModel = new TipoLeitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $tipoleitorModel = Tipoleitor::find()->all();

        return $this->render('estleitor/index', ['searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'tipoleitorModel'=>$tipoleitorModel]);
    }

    public function actionEstleitorView($id)
    {
        return $this->renderAjax('estleitor/view', ['model' => $this->findModelEstleitor($id),]);
    }

    public function actionEstleitorCreate()
    {
        $model = new TipoLeitor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "'.$model->estatuto.'" foi adicionado.');
            return $this->redirect('estleitor');
        }

        return $this->renderAjax('estleitor/create', ['model' => $model,]);
    }

    public function actionEstleitorUpdate($id)
    {
        $model = $this->findModelEstleitor($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '<strong>Informação:</strong>O estatuto "'.$model->estatuto.'" foi atualizado.');
            return $this->redirect('estleitor');
        }

        return $this->renderAjax('estleitor/update', ['model' => $model,]);
    }

    public function actionEstleitorDelete($id)
    {

        $oldEstatuto=$this->findModelCursos($id)->nome;
        $this->findModelEstleitor($id)->delete();
        Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O estatuto ".$oldEstatuto." foi apagado.");

        return $this->redirect(['estleitor']);
    }

    protected function findModelEstleitor($id)
    {
        if (($model = TipoLeitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
    }

    #endregion

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

        return $this->render('irregularidades/index', ['dataProvider' => $dataProvider, 'irregularidadesModels'=>$irregularidadesModels]);
    }

    public function actionIrregularidadesUpdate($id)
    {
        $model = $this->findModelIrregularidades($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'A irregularidade para o tipo de obra "'. $model->irregularidade .'" foi atualizada.');
            return $this->redirect('irregularidades');
        }

        return $this->renderAjax('irregularidades/update', ['model' => $model,]);
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

        return $this->render('recibos/index', ['dataProvider' => $dataProvider, 'recibosModel'=> $recibosModel]);

    }

    public function actionRecibosUpdate($id)
    {
        $model = $this->findModelRecibos($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> A definição "'. $model->info .'" foi alterada com sucesso.');
            return $this->redirect('recibos');
        }

        return $this->renderAjax('recibos/update', ['model' => $model,]);
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
        $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', 'opac_reservaExemplares'])]);
        $resexemplares = Config::find()->all();

        return $this->render('resexemplar/index',[
            'resexemplares'=>$resexemplares,
            'dataProvider'=>$dataProvider]);
    }

    public function actionResexemplarUpdate($id){

        $model = $this->findModelResexemplar($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success','A '. $model->info .' foi alterada com sucesso.');
            return $this->redirect('slidesopac');
        }

        return $this->renderAjax('slidesopac/update', ['model' => $model,]);
    }

    public function findModelResexemplar($id){
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
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

        return $this->render('slidesopac/index', ['dataProvider' => $dataProvider, 'slidesopacModels'=> $slidesopacModel]);

    }

    public function actionSlidesopacUpdate($id)
    {
        $model = $this->findModelSlidesopac($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> A definição "'. $model->info .'" foi alterada com sucesso.');
            return $this->redirect('slidesopac');
        }

        return $this->renderAjax('slidesopac/update', ['model' => $model,]);
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

    #region Arrumação
    /**
     * Gestão da funcionalidade "arrumar" homepage.
     *
     * @return string
     */
    public function actionArrumacao()
    {
        return $this->render('arrumacao/index');
    }
    #endregion

    #endregion

}