<?php
namespace backend\controllers;

use Yii;
use backend\models\ChangeUsernameForm;
use common\models\ChangePasswordForm;
use backend\models\CduSearch;
use backend\models\EquipaCreateForm;
use backend\models\EquipaSearch;
use app\models\BibliotecaSearch;
use app\models\CursoSearch;
use app\models\LogotiposForm;
use app\models\NoticiasSearch;
use app\models\PostotrabalhoSearch;
use app\models\TipoLeitorSearch;
use app\models\TipoexemplarSearch;
use common\models\AuthAssignment;
use common\models\Cdu;
use common\models\Funcionario;
use common\models\Tipoleitor;
use common\models\User;
use common\models\Biblioteca;
use common\models\Config;
use common\models\Curso;
use common\models\Entidade;
use common\models\Estatutoexemplar;
use common\models\Leitor;
use common\models\Aluno;
use common\models\Noticias;
use common\models\Postotrabalho;
use common\models\Tipoirregularidade;
use common\models\Tipoexemplar;
use common\models\Exemplar;
use common\models\Obra;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

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
                            'conta', 'conta-username','conta-password',
                            'entidade', 'entidade-update','entidade-reset',
                            'bibliotecas','bibliotecas-view','bibliotecas-create','bibliotecas-update', 'bibliotecas-delete',
                            'postos', 'postos-view', 'postos-create', 'postos-update', 'postos-delete',
                            'logotipos','logotipos-view','logotipos-update','logotipos-reset',
                            'noticias','noticias-view','noticias-create','noticias-update','noticias-delete',
                            'equipa', 'equipa-view', 'equipa-associate', 'equipa-create', 'equipa-update', 'equipa-delete',
                            'tipoexemplar', 'tipoexemplar-view', 'tipoexemplar-create', 'tipoexemplar-update', 'tipoexemplar-delete',
                            'estexemplar','estexemplar-update','estexemplar-reset',
                            'cdu','cdu-view','cdu-create','cdu-update','cdu-delete',
                            'estleitor','estleitor-view','estleitor-create','estleitor-update','estleitor-delete',
                            'irregularidades','irregularidades-update',
                            'cursos','cursos-view','cursos-create','cursos-update','cursos-delete',
                            'recibos','recibos-update',
                            'resexemplar', 'resexemplar-update',
                            'slidesopac','slidesopac-update',
                            'arrumacao', 'arrumacao-update'],
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
        if ((Yii::$app->user->can('acessoAdministracao'))) {
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
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    #region Conta
    public function actionConta()
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            return $this->render('conta/index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionContaUsername()
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $user = Yii::$app->user;
            $identity = $user->identity->username;

            $UsernameModel = new ChangeUsernameForm();

            if (Yii::$app->request->isAjax && $UsernameModel->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($UsernameModel);
            }
            elseif($UsernameModel->load(Yii::$app->request->post()) && $UsernameModel->change()) {
                Yii::$app->session->setFlash('success',
                    "<strong>Informação: </strong> O username foi alterado com sucesso! ");
                return $this->redirect(['conta']);
            }
            return $this->renderAjax('conta/username', ['model'=> $UsernameModel, 'identity' => $identity]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionContaPassword()
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {    

            $PasswordModel = new ChangePasswordForm();

            if (Yii::$app->request->isAjax && $PasswordModel->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($PasswordModel);
            }
            elseif($PasswordModel->load(Yii::$app->request->post())&& $PasswordModel->change()) {
                Yii::$app->session->setFlash('success',
                    "<strong>Informação:</strong> A password foi alterada com sucesso!");
                return $this->redirect(['conta']);
            }
            return $this->renderAjax('conta/password',['model' => $PasswordModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verDadosEntidade'))) {
            $searchModel = new Entidade();
            $entidadeModel = Config::find()->all();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('entidade/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                'entidadeModels' => $entidadeModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEntidadeUpdate($id)
    {
        if ((Yii::$app->user->can('editarDadosEntidade'))) {    
            $model = $this->findModelEntidade($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> " . $model->info. " foi alterado.");
                return $this->redirect(['entidade']);
            }
            return $this->renderAjax('entidade/update', ['model' => $model]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEntidadeReset($id)
    {
        if ((Yii::$app->user->can('editarDadosEntidade'))) {
            $model = $this->findModelEntidade($id);
            $model->reset($id);
            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> " . $model->info. " foi reposto.");

            return $this->redirect(['entidade/index']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verBibliotecas'))) {
            $searchModel = new BibliotecaSearch();
            $bibliotecasModel = Biblioteca::find()->all();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('bibliotecas/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                'bibliotecasModels' => $bibliotecasModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionBibliotecasView($id)
    {
        if ((Yii::$app->user->can('verBibliotecas'))) {

            if (($model = Biblioteca::findOne($id)) !== null) {
                return $this->renderAjax('bibliotecas/view', ['model' => $model]);
            }

            throw new NotFoundHttpException();
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionBibliotecasCreate()
    {
        if ((Yii::$app->user->can('inserirBibliotecas'))) {
            $model = new Biblioteca();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Foi adicionada uma nova biblioteca.");
                return $this->redirect('bibliotecas');
            }

            return $this->renderAjax('bibliotecas/create', ['model'=>$model]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionBibliotecasUpdate($id)
    {
        if ((Yii::$app->user->can('inserirBibliotecas'))) {
            $model = $this->findModelBibliotecas($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "A biblioteca foi atualizada.");
                return $this->redirect('bibliotecas');
            }
            return $this->renderAjax('bibliotecas/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionBibliotecasDelete($id)
    {
        if ((Yii::$app->user->can('eliminarBibliotecas'))) {
            $leitores = Leitor::find()->where("Biblioteca_id = '$id'")->count();
            $postos = Postotrabalho::find()->where("Biblioteca_id = '$id'")->count();
            $exemplares = Exemplar::find()->where("Biblioteca_id = '$id'")->count();
            if ($leitores == 0 && $postos == 0 && $exemplares == 0) {
                $this->findModelBibliotecas($id)->delete();
                Yii::$app->session->setFlash('success', "A biblioteca foi eliminada.");
                return $this->redirect(['bibliotecas']);
            }
            $errorDisplay = 'Existem dados agregados a esta biblioteca, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($postos > 0 ? '<br>&#9679 '.$postos.' posto(s) de trabalho':'').
                ($leitores > 0 ? '<br>&#9679 '.$leitores.' leitor(es)':'').
                ($exemplares > 0 ? '<br>&#9679 '.$exemplares.' exemplares(es)':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(['bibliotecas']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verPostosTrabalho'))) {
            $searchModel = new PostotrabalhoSearch();
            $postoTrabalhoModel = Postotrabalho::find()->all();
            $bibliotecasCount = Biblioteca::find()->count();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('postos/index',['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'postoTrabalhoModels' => $postoTrabalhoModel, 'bibliotecasCount'=>$bibliotecasCount]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionPostosView($id){
        if ((Yii::$app->user->can('verPostosTrabalho'))) {
            //FIXME
            if (($model = Postotrabalho::findOne($id)) !== null) {
                return $this->renderAjax('postos/view', ['model' => $model]);
            }

            return 1;
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionPostosCreate(){
        if ((Yii::$app->user->can('inserirPostosTrabalho'))) {
            $model = new Postotrabalho();
            new Biblioteca();
            $listaBibliotecas = Biblioteca::find()->all();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'O posto de trabalho "'.$model->designacao.'"foi adicionado com sucesso.');
                return $this->redirect('postos');
            }

            return $this->renderAjax('postos/create', ['model'=>$model, 'listaBibliotecas'=>$listaBibliotecas]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }
    
    public function actionPostosUpdate($id)
    {
        if ((Yii::$app->user->can('editarPostosTrabalho'))) {
            $model = $this->findModelPostostrabalho($id);
            new Biblioteca();
            $listaBibliotecas = Biblioteca::find()->all();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'O posto de trabalho "'.$model->designacao.'"foi atualizado com sucesso.');
                return $this->redirect('postos');
            }
            return $this->renderAjax('postos/update', ['model' => $model, 'listaBibliotecas'=>$listaBibliotecas]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionPostosDelete($id)
    {
        if ((Yii::$app->user->can('eliminarPostosTrabalho'))) {
            $reservas = Postotrabalho::find()->where("PostoTrabalho_id = '$id'")->count();
            if ($reservas == 0) {
                $this->findModelPostostrabalho($id)->delete();

            Yii::$app->session->setFlash('success', "O posto de trabalho foi eliminado.");
            return $this->redirect(['postos']);
            }
            $errorDisplay = 'Existem dados agregados a este posto de trabalho, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($reservas > 0 ? '<br>&#9679 '.$reservas.' reserva(s) de posto':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(['postos']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $logotiposModels = Config::find()->where(['like', 'key', 'logotipo'])->orWhere(['like', 'key', 'favicon'])->all();
            $dataProvider = new ActiveDataProvider(
                ['query' => Config::find()->where(['like', 'key', 'logotipo'])->orWhere(['like', 'key', 'favicon'])]
            );

            return $this->render('logotipos/index', ['dataProvider' => $dataProvider, 'logotiposModels'=>$logotiposModels]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionLogotiposView($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {

            return $this->renderAjax('logotipos/view', ['model' => $this->findModelLogotipos($id)]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionLogotiposUpdate($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $model = $this->findModelLogotipos($id);

            if(Yii::$app->request->isPost)
            {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if ($model->upload($id)) {
                    Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O " . $model->info. " foi adicionado.");
                    return $this->redirect('logotipos');
                }
            }
            return $this->renderAjax('logotipos/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionLogotiposReset($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $model = $this->findModelLogotipos($id);
            $model->reset($id);
            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> O ' . $model->info. ' foi reposto para <span class="label label-danger">Não Definido</span>');

            return $this->redirect(['config/logotipos']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $searchModel = new NoticiasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $noticiasModel = Noticias::find()->all();

            return $this->render('noticias/index',
                ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'noticiasModel'=> $noticiasModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Displays a single Noticias model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNoticiasView($id)
    {
        if ((Yii::$app->user->can('verNoticias'))) {
            return $this->renderAjax('noticias/view', [
                'model' => $this->findModelNoticias($id),
            ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Creates a new Noticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNoticiasCreate()
    {
        if ((Yii::$app->user->can('verNoticias'))) {
            $model = new Noticias();

            $user = Yii::$app->user;
            $leitor = Leitor::find()->where(['user_id' => $user->id])->one();

            if($leitor!=null)
            {
                $identity = $leitor->nome;
            }else{
                $identity = '@' . $user->identity->username . '';
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A notícia "' . $model->assunto. '" foi adicionada.');

                return $this->redirect(['noticias', '#' => $model->id]);
            }

            return $this->renderAjax('noticias/create', ['model' => $model,'identity'=> $identity]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Updates an existing Noticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNoticiasUpdate($id)
    {
        if ((Yii::$app->user->can('verNoticias'))) {
            $oldNoticia = $this->findModelNoticias($id);
            $model = $this->findModelNoticias($id);

            $user = Yii::$app->user;
            $leitor = Leitor::find()->where(['user_id' => $user->id])->one();

            if($leitor!=null)
            {
                $identity = $leitor->nome;
            }else{
                $identity = '@' . $user->identity->username . '';
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if($oldNoticia->assunto == $model->assunto){
                    Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A notícia "' . $model->assunto. '" foi atualizada.');
                }else{
                    Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A notícia "' . $oldNoticia->assunto. '" foi atualizada para "' . $model->assunto . '"');
                }

                return $this->redirect(['noticias', '#' => $model->id]);
            }

            return $this->renderAjax('noticias/update', ['model' => $model,'identity'=> $identity]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Deletes an existing Noticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionNoticiasDelete($id)
    {  
        if ((Yii::$app->user->can('verNoticias'))) {
            $oldNoticia = $this->findModelNoticias($id);
            $this->findModelNoticias($id)->delete();

            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A notícia "' . $oldNoticia->assunto . '" foi apagada.');

            return $this->redirect(['noticias']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Finds the Noticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelNoticias($id)
    {
        if (($model = Noticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página requisitada não existe.');
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
        if ((Yii::$app->user->can('verOperadores'))) {
            $operadores = User::find()->leftJoin(AuthAssignment::tableName(), "user_id = id")->where("item_name LIKE '%operador%'")->all();
            $operadorCount = User::find()->leftJoin(AuthAssignment::tableName(), "user_id = id")->where("item_name LIKE '%operador%'")->count();
            $searchModel = new EquipaSearch();

            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('equipa/index',
                ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                    'operadores' => $operadores, 'operadorCount' => $operadorCount]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEquipaView($id){
        if ((Yii::$app->user->can('verOperadores'))) {
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
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEquipaAssociate()
    {
        if ((Yii::$app->user->can('inserirOperadores'))) {
            //FIXME
            $model = new EquipaCreateForm();
            $leitores = Leitor::find()->all();
            $users = Leitor::find()->all();


            if($leitores == null){
                Yii::$app->session->setFlash('error', "Não existem Leitores possíveis para associar");
                return $this->redirect('equipa');
            }else if($model->associateOperador() == false) {
                Yii::$app->session->setFlash('error', "Houve um erro.");
                return $this->redirect('equipa');
            }else if($model->load(Yii::$app->request->post()) && $model->associateOperador()) {
                Yii::$app->session->setFlash('success', "O Operador foi modificado.");
                return $this->redirect('equipa');
            }

            return $this->renderAjax('equipa/associate', [
                'model'=>$model,
                'leitores'=>$leitores,
                'users' => $users]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEquipaUpdate($id){
        if ((Yii::$app->user->can('editarOperadores'))) {
            $model = new EquipaCreateForm();
            $leitores = Leitor::find()->all();
            $listaBibliotecas = Biblioteca::find()->all();
            $listaTiposLeitors = Tipoleitor::find()->all();
            $leitores = Leitor::find()->all();

            if ($model->load(Yii::$app->request->post()) && $model->updateRole($id)) {
                Yii::$app->session->setFlash('success', "O Operador foi atualizado.");
                return $this->redirect('equipa');
            }elseif($model->load(Yii::$app->request->post()) && !($model->updateRole($id))){
                Yii::$app->session->setFlash('danger', "Lamentamos!");  // TODO
                return $this->redirect('equipa');
            }

            return $this->renderAjax('equipa/update', [
                'model' => $model,
                'leitores'=>$leitores,
                'leitores' > $leitores,
                'listaBibliotecas' => $listaBibliotecas,
                'listaTiposLeitors' => $listaTiposLeitors]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEquipaDelete($id){
        if ((Yii::$app->user->can('eliminarOperadores'))) {
            $funcionario = $this->findModelEquipa($id);
            $leitor = Leitor::findOne($funcionario->Leitor_id);
            $user = User::findOne($leitor->user_id);
            $user->status = 9;

            $user->save();
            $funcionario->delete();
            $leitor->delete();

            return $this->redirect('equipa');
        }
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
        if ((Yii::$app->user->can('verTiposExemplares'))) {
            $searchModel = new TipoexemplarSearch();
            $tipoexemplarModels = Tipoexemplar::find()->all();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('tipoexemplar/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'tipoexemplarModels' => $tipoexemplarModels]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionTipoexemplarView($id)
    {
        if ((Yii::$app->user->can('verTiposExemplares'))) {
            if (($model = Tipoexemplar::findOne($id)) !== null) {
                return $this->renderAjax('tipoexemplar/view', ['model' => $model]);
            }

            throw new NotFoundHttpException();
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionTipoexemplarCreate()
    {
        if ((Yii::$app->user->can('inserirTiposExemplares'))) {
            $model = new Tipoexemplar();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Foi adicionada um novo tipo de exemplar.");
                return $this->redirect('tipoexemplar');
            }

            return $this->renderAjax('tipoexemplar/create', ['model' => $model]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionTipoexemplarUpdate($id)
    {
        if ((Yii::$app->user->can('inserirTiposExemplares'))) {
            $model = $this->findModelTipoexemplar($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O tipo de exemplar "' . $model->designacao . '" foi atualizado.');
                return $this->redirect('tipoexemplar');
            }

            return $this->renderAjax('tipoexemplar/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionTipoexemplarDelete($id)
    {
        if ((Yii::$app->user->can('inserirTiposExemplares'))) {
            $exemplares = Exemplar::find()->where("TipoExemplar_id = '$id'")->count();
            if ($exemplares == 0) {
                $this->findModelTipoexemplar($id)->delete();

            Yii::$app->session->setFlash('success', "O tipo de exemplar foi eliminado.");
            return $this->redirect(['tipoexemplar']);
            }
            $errorDisplay = 'Existem dados agregados a este tipo de exemplar, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($exemplares > 0 ? '<br>&#9679 '.$exemplares.' exemplar(es)':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(['tipoexemplar']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verEstatutosExemplares'))) {
            $estExemplarModels = Estatutoexemplar::find()->all();
            $dataProvider = new ActiveDataProvider(['query' => EstatutoExemplar::find()]);

            return $this->render('estexemplar/index', ['dataProvider' => $dataProvider, 'estExemplarModels' => $estExemplarModels]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEstexemplarUpdate($id)
    {
        if ((Yii::$app->user->can('inserirEstatutosExemplares'))) {
            $model = $this->findModelEstexemplar($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "' . $model->estatuto . '" foi atualizado.');
                return $this->redirect('estexemplar');
            }

            return $this->renderAjax('estexemplar/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEstexemplarReset($id)
    {
        if ((Yii::$app->user->can('verEstatutosExemplares'))) {
            $model = $this->findModelEstexemplar($id);
            $model->reset($id);
            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "' . $model->estatuto. '" foi reposto.');

            return $this->redirect(['estexemplar']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verCDU'))) {
            $searchModel = new CduSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $cduModel = Cdu::find()->all();

            return $this->render('cdu/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                    'cduModel'=>$cduModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Displays a single Cdu model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCduView($id)
    {
        if ((Yii::$app->user->can('verCDU'))) {
            return $this->renderAjax('cdu/view', ['model' => $this->findModelCdu($id),]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Creates a new Cdu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCduCreate()
    {
        if ((Yii::$app->user->can('inserirCDU'))) {
            $model = new Cdu();
            $searchModel = new CduSearch();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $endPage = $searchModel->search(Yii::$app->request->queryParams)->pagination->getLimit();

                return $this->redirect(['cdu', 'page'=> $endPage, '#'=> $model->id]);
            }

            return $this->renderAjax('cdu/create', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Updates an existing Cdu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCduUpdate($id)
    {
        if ((Yii::$app->user->can('inserirCDU'))) {
            $oldCdu = $this->findModelCdu($id);
            $model = $this->findModelCdu($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> O Código Decimal Universal '.$oldCdu->codCdu.' - "'.$oldCdu->designacao.'" foi alterado para '.$model->codCdu.' - "'.$model->designacao.'".');
                return $this->redirect(['cdu', '#' => $model->id]);
            }

            return $this->renderAjax('cdu/update', ['model' => $model]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Deletes an existing Cdu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCduDelete($id)
    {
        if ((Yii::$app->user->can('eliminarCDU'))) {
            $obras = Obra::find()->where("Cdu_id = '$id'")->count();
            if ($obras == 0) {
                $oldCdu = $this->findModelCdu($id);
                $this->findModelCdu($id)->delete();

                $searchModel = new CduSearch();
                $endPage = $searchModel->search(Yii::$app->request->queryParams)->pagination->getLimit();

                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> O Código Decimal Universal '.$oldCdu->codCdu.' - "'.$oldCdu->designacao.'" foi apagado.');

                return $this->redirect(['cdu', 'page'=> $endPage]);
            }
            $errorDisplay = 'Existem dados agregados a este CDU, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($obras > 0 ? '<br>&#9679 '.$obras.' obra(s)':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(['cdu']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Finds the Cdu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cdu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelCdu($id)
    {
        if (($model = Cdu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Código Decimal Universal não encontrado.');
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
        if ((Yii::$app->user->can('verTiposLeitor'))) {
            $searchModel = new TipoLeitorSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $tipoleitorModel = Tipoleitor::find()->all();

            return $this->render('estleitor/index', ['searchModel' => $searchModel,
                'dataProvider' => $dataProvider, 'tipoleitorModel'=>$tipoleitorModel]);
        }
    }

    public function actionEstleitorView($id)
    {
        if ((Yii::$app->user->can('verTiposLeitor'))) {
            return $this->renderAjax('estleitor/view', ['model' => $this->findModelEstleitor($id),]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEstleitorCreate()
    {
        if ((Yii::$app->user->can('inserirTiposLeitor'))) {
            $model = new TipoLeitor();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O estatuto "'.$model->estatuto.'" foi adicionado.');
                return $this->redirect('estleitor');
            }

            return $this->renderAjax('estleitor/create', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEstleitorUpdate($id)
    {
        if ((Yii::$app->user->can('inserirTiposLeitor'))) {
            $model = $this->findModelEstleitor($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong>O estatuto "'.$model->estatuto.'" foi atualizado.');
                return $this->redirect('estleitor');
            }

            return $this->renderAjax('estleitor/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionEstleitorDelete($id)
    {
        if ((Yii::$app->user->can('eliminarTiposLeitor'))) {
            $leitores = Leitor::find()->where("TipoLeitor_id = '$id'")->count();
            if ($leitores == 0) {
                $oldEstatuto=$this->findModelCursos($id)->nome;
                $this->findModelEstleitor($id)->delete();
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O estatuto ".$oldEstatuto." foi apagado.");

                return $this->redirect(['estleitor']);
            }
            $errorDisplay = 'Existem dados agregados ao estatuto de leitor, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($leitores > 0 ? '<br>&#9679 '.$leitores.' leitor(es)':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(['estleitor']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verTiposIrregularidades'))) {
            $dataProvider = new ActiveDataProvider(['query' => Tipoirregularidade::find()]);
            $irregularidadesModels = Tipoirregularidade::find()->all();

            return $this->render('irregularidades/index', ['dataProvider' => $dataProvider, 'irregularidadesModels'=>$irregularidadesModels]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionIrregularidadesUpdate($id)
    {
        if ((Yii::$app->user->can('inserirTiposIrregularidades'))) {
            $model = $this->findModelIrregularidades($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'A irregularidade para o tipo de obra "'. $model->irregularidade .'" foi atualizada.');
                return $this->redirect('irregularidades');
            }

            return $this->renderAjax('irregularidades/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $cursosModels = Curso::find()->all();

            $searchModel = new CursoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('cursos/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'cursosModels'=>$cursosModels]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionCursosView($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            return $this->renderAjax('cursos/view', ['model' => $this->findModelCursos($id)]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionCursosCreate()
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $model = new Curso();
            $searchModel = new CursoSearch();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$model->nome." foi adicionado com sucesso.");

                $endPage = $searchModel->search(Yii::$app->request->queryParams)->pagination->getLimit();

                return $this->redirect(['cursos', 'page'=>$endPage]);
            }

            return $this->renderAjax('cursos/create', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionCursosUpdate($id){
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $model = $this->findModelCursos($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$model->nome." foi atualizado com sucesso.");
                return $this->redirect(Yii::$app->request->referrer);
            }

            return $this->renderAjax('cursos/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionCursosDelete($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            $alunos = Aluno::find()->where("Curso_id = '$id'")->count();
            if ($alunos == 0) {
                $oldCurso=$this->findModelCursos($id)->nome;

                $this->findModelCursos($id)->delete();
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O curso ".$oldCurso." foi apagado.");

                return $this->redirect(Yii::$app->request->referrer);
            }
            $errorDisplay = 'Existem dados agregados a este curso, será necessário apagá-los primeiro para poder efetuar esta ação'.
                ($alunos > 0 ? '<br>&#9679 '.$alunos.' leitor(es) (do tipo aluno)':'');
            Yii::$app->session->setFlash('error', $errorDisplay);
            return $this->redirect(Yii::$app->request->referrer);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    protected function findModelCursos($id)
    {
        if (($model = curso::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException();
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
        if ((Yii::$app->user->can('ativacaoRecibosEmprestimos'))) {
            $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', "recibo_"])]);
            $recibosModel = Config::find()->all();

            return $this->render('recibos/index', ['dataProvider' => $dataProvider, 'recibosModel'=> $recibosModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionRecibosUpdate($id)
    {
        if ((Yii::$app->user->can('ativacaoRecibosEmprestimos'))) {
            $model = $this->findModelRecibos($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> A definição "'. $model->info .'" foi alterada com sucesso.');
                return $this->redirect('recibos');
            }

            return $this->renderAjax('recibos/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('verReservaFilaEspera'))) {
            $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', 'opac_reservaExemplares'])]);
            $resexemplares = Config::find()->all();

            return $this->render('resexemplar/index',[
                'resexemplares'=>$resexemplares,
                'dataProvider'=>$dataProvider]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionResexemplarUpdate($id){
        if ((Yii::$app->user->can('verReservaFilaEspera'))) {
            $model = $this->findModelResexemplar($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success','A '. $model->info .' foi alterada com sucesso.');
                return $this->redirect('resexemplar');
            }

            return $this->renderAjax('resexemplar/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function findModelResexemplar($id){
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            if (($model = Config::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException();
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Gestão da Últimas Obras Adquiridas (OPAC) homepage.
     *
     * @return string
     */
    public function actionSlidesopac()
    {
        if ((Yii::$app->user->can('ativarObrasSlideShow'))) {
            $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', "opac_obrasAdquiridas"])]);
            $slidesopacModel = Config::find()->all();

            return $this->render('slidesopac/index', ['dataProvider' => $dataProvider, 'slidesopacModels'=> $slidesopacModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionSlidesopacUpdate($id)
    {
        if ((Yii::$app->user->can('desativarObrasSlideShow'))) {
            $model = $this->findModelSlidesopac($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> A definição "'. $model->info .'" foi alterada com sucesso.');
                return $this->redirect('slidesopac');
            }

            return $this->renderAjax('slidesopac/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
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
        if ((Yii::$app->user->can('ativacaoEmArrumacao'))) {
            $dataProvider = new ActiveDataProvider(['query' => Config::find()->where(['like','key', "modulo_arrumacao"])]);
            $ArrumacaoModel = Config::find()->all();

            return $this->render('arrumacao/index', ['dataProvider' => $dataProvider, 'ArrumacaoModel' => $ArrumacaoModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionArrumacaoUpdate($id)
    {
        if ((Yii::$app->user->can('desativacaoEmArrumacao'))) {
            $model = $this->findModelArrumacao($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> A definição "'. $model->info .'" foi alterada com sucesso.');
                return $this->redirect('arrumacao');
            }

            return $this->renderAjax('arrumacao/update', ['model' => $model,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    protected function findModelArrumacao($id)
    {
        if ((Yii::$app->user->can('acessoAdministracao'))) {
            if (($model = Config::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException();
        }

    }

    #endregion


}