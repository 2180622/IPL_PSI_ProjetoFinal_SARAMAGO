<?php
namespace backend\controllers;

use app\models\ColecaoSearch;
use app\models\ExemplarSearch;
use app\models\ObraAutorSearch;
use app\models\ObraSearch;
use app\models\AutorSearch;
use backend\models\AutorForm;
use backend\models\ObraForm;
use backend\models\ObraUpdateForm;
use common\models\Autor;
use common\models\Cdu;
use common\models\Colecao;
use common\models\Exemplar;
use common\models\Materialav;
use common\models\Monografia;
use common\models\Obra;
use common\models\ObraAutor;
use common\models\Pubperiodica;
use common\models\Tipoexemplar;
use common\models\Biblioteca;
use common\models\Estatutoexemplar;
use Yii;
use yii\helpers\ArrayHelper;
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
class CatController extends Controller
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
                            'obra-create','obra-update','obra-delete','obra-view','obra-full',
                            'autor-associate', 'autor-disassociate',
                            'analitico-create','analitico-view','analitico-update','analitico-delete',
                            'exemplar-create','exemplar-update','exemplar-view','exemplar-delete','exemplar-pedir',
                            'autor-view','autor-create', 'autor-update','autor-delete',
                            'colecao-create','colecao-update','colecao-view','colecao-delete',
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

    #region Catalogo / root
    /**
     * Lists all obra models.
     * @return mixed
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('acessoCatalogo'))) {
            $this->layout = "minor";

            $obrasModel = Obra::find()->all();
            $autorModel = Autor::find()->all();
            $colecaoModel = Colecao::find()->all();

            $obrasTotalCount = Obra::find()->count();
            $autorTotalCount = Autor::find()->count();

            $cduAll = ArrayHelper::map(Cdu::find()->all(), 'id', 'designacao', 'codCdu', ['enctype' => 'multipart/form-data']);
            $tiposExemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(), 'id', 'designacao', 'tipo', ['enctype' => 'multipart/form-data']);
            $colecaoAll = ArrayHelper::map(Colecao::find()->all(), 'id', 'tituloColecao', ['enctype' => 'multipart/form-data']);

            $ObraSearchModel = new ObraSearch();
            $ObraDataProvider = $ObraSearchModel->search(Yii::$app->request->queryParams);

            $AutorSearchModel = new AutorSearch();
            $AutorDataProvider = $AutorSearchModel->search(Yii::$app->request->queryParams);

            $ColecaoSearchModel = new ColecaoSearch();
            $ColecaoDataProvider = $ColecaoSearchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'obrasModel' => $obrasModel,
                'obrasTotalCount' => $obrasTotalCount,
                'ObraSearchModel' => $ObraSearchModel,
                'ObraDataProvider' => $ObraDataProvider,

                'autorModel' => $autorModel,
                'autorTotalCount' => $autorTotalCount,
                'AutorSearchModel' => $AutorSearchModel,
                'AutorDataProvider' => $AutorDataProvider,

                'colecaoModel' => $colecaoModel,
                'ColecaoSearchModel' => $ColecaoSearchModel,
                'ColecaoDataProvider' => $ColecaoDataProvider,

                'cduAll' => $cduAll, 'tiposExemplarAll' => $tiposExemplarAll, 'colecaoAll' => $colecaoAll]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    #endregion

    #region Obra
    /**
     * Displays a single obra model in modal.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionObraView($id)
    {
        if ((Yii::$app->user->can('verObras')))
        {
            return $this->renderAjax('obra/view', ['model' => $this->findObraModel($id),]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Displays a single obra full model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionObraFull($id)
    {
        if ((Yii::$app->user->can('verObras')))
        {
            $this->layout = 'minor';

            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);
            $tipoExemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);

            $searchModelExemplar = new ExemplarSearch();
            $dataProviderExemplar = $searchModelExemplar->search(Yii::$app->request->queryParams);

            $searchModelAutor = new ObraAutorSearch();
            $dataProviderAutor = $searchModelAutor->search(Yii::$app->request->queryParams);

            return $this->render('obra/view-full',
                [
                    'model' => $this->findObraModel($id),
                    'searchModelExemplar' => $searchModelExemplar, 'dataProviderExemplar' => $dataProviderExemplar,
                    'searchModelAutor' => $searchModelAutor, 'dataProviderAutor' => $dataProviderAutor,
                    'bibliotecaAll' => $bibliotecaAll,'tipoExemplarAll'=>$tipoExemplarAll,

                ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Creates a new obra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionObraCreate($scenario)
    {
        if ((Yii::$app->user->can('inserirObras'))) {

            if($scenario == 'monografia')
            {
                $model = new ObraForm(['scenario' => ObraForm::MONOGRAFIA]);

            }elseif($scenario == 'materialAv')
            {
                $model = new ObraForm(['scenario' => ObraForm::MATERIALAV]);

            }elseif ($scenario == 'pubPeriodica')
            {
                $model = new ObraForm(['scenario' => ObraForm::PUBPERIODICA]);
            }

            $cduAll = ArrayHelper::map(Cdu::find()->all(),'id','designacao','codCdu',['enctype' => 'multipart/form-data']);
            $colecaoAll = ArrayHelper::map(Colecao::find()->all(),'id','tituloColecao',['enctype' => 'multipart/form-data']);

            if($model->load(Yii::$app->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if($model->create()) {

                    Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A obra "' . $model->titulo . '" foi adicionada.');

                    return $this->redirect(['index']);
                }else
                    {
                        Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> Ocorreu um erro ao adicionar uma obra, tente de novo.");

                        return $this->redirect(['index']);
                    }
            }

            return $this->renderAjax('obra/create', ['model' => $model, 'scenario'=>$scenario,
                    'cduAll'=> $cduAll, 'colecaoAll' => $colecaoAll]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Updates an existing obra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param $scenario
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionObraUpdate($scenario,$id)
    {
        if ((Yii::$app->user->can('editarObras')))
        {
            $cduAll = ArrayHelper::map(Cdu::find()->all(),'id','designacao','codCdu',['enctype' => 'multipart/form-data']);
            $colecaoAll = ArrayHelper::map(Colecao::find()->all(),'id','tituloColecao',['enctype' => 'multipart/form-data']);

            if((Obra::findOne($id)) !== null)
            {
                $model = new ObraUpdateForm($id);

                if($scenario == 'monografia')
                {
                    $model->scenario = $scenario;

                }
                elseif($scenario == 'materialAv')
                {
                    $model->scenario = $scenario;

                }
                elseif ($scenario == 'pubPeriodica')
                {
                    $model->scenario = $scenario;
                }

                if ($model->load(Yii::$app->request->post()))
                {
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                    if ($model->updateObra())
                    {
                        Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A obra "' . $model->titulo . '" foi atualizada.');
                        return $this->redirect(['cat/obra-full', 'id' => $id]);
                    }else
                        {
                            Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> Ocorreu um erro ao atualizar a obra, tente de novo.");return $this->redirect(['cat/obra-view-full', 'id' => $id]);
                            return $this->redirect(['cat/obra-full', 'id' => $id]);
                        }
                }
            }

            return $this->renderAjax('obra/update', ['model' => $model, 'scenario'=>$scenario, 'cduAll'=> $cduAll, 'colecaoAll' => $colecaoAll,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Deletes an existing obra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionObraDelete($id)
    {
        if ((Yii::$app->user->can('editarObras'))) {

            if($obra = $this->findObraModel($id))
            {
                if($obra->tipoObra == 'monografia')
                {
                    $monografia = Monografia::findOne(['Obra_id'=>$id]);
                    $monografia->delete();
                }
                elseif($obra->tipoObra == 'materialAv')
                {
                    $materialAv = Materialav::findOne(['Obra_id'=>$id]);
                    $materialAv->delete();
                }
                elseif ($obra->tipoObra == 'pubPeriodica')
                {
                    $pubPeriodica = Pubperiodica::findOne(['Obra_id'=>$id]);
                    $pubPeriodica->delete();
                }

                $obra->delete();

                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> A obra "' . $obra->titulo . '" ('.$obra->ano.') foi apagada.');
                return $this->redirect(['cat']);
            }

            return $this->redirect(['cat']);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * @param $idObra
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionAutorAssociate($idObra)
    {
        if($obra = $this->findObraModel($idObra))
        {
            $model = new ObraAutor();
            $autorAll = ArrayHelper::map(
                Autor::find()->select(["id, concat(primeiroNome, ' ',segundoNome, ' ',apelido, ' (',dataNasc,')') as Autor"])->asArray()->all(),
                'id', 'Autor',['enctype' => 'multipart/form-data']);

            if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            elseif($model->load(Yii::$app->request->post()) && $model->save())
            {
                $autor = $model->autor->primeiroNome.' '.$model->autor->segundoNome.' '.$model->autor->apelido;

                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> Foi associada a obra o autor: "' . $autor . '"');

                return $this->redirect(['cat/obra-full', 'id'=>$idObra]);
            }

            return $this->renderAjax('obra/autor-associate', ['model' => $model,'autorAll'=>$autorAll,'idObra'=>$idObra]);
        }

        return $this->redirect(['cat/obra-full', 'id' => $obra->id]);

    }

    public function actionAutorDisassociate($idObra,$idAutor)
    {

        if($obraAutor = $this->findModelObraAutor($idObra, $idAutor))
        {
            $obraAutor->delete();

            $autor = Autor::findOne($idAutor);
            $autor = $autor->primeiroNome.' '.$autor->segundoNome.' '.$autor->apelido;

            Yii::$app->session->setFlash('success', '<strong>Informação:</strong> Foi desassociado da obra, o autor "' . $autor . '"');

            return $this->redirect(['cat/obra-full', 'id'=>$idObra]);
        }else{

            Yii::$app->session->setFlash('warning', '<strong>Informação:</strong> Ocorreu um erro ao desassociar um autor, tente novamente.');

            return $this->redirect(['cat/obra-full', 'id'=>$idObra]);
        }

        return $this->redirect(['cat/obra-view-full', 'id' => $obra->id]);

    }

    /**
     * Finds the obra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Obra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findObraModel($id)
    {
        if (($model = Obra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Obra não encontrada.');
    }

    /**
     * Finds the ObraAutor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Obra_id
     * @param integer $Autor_id
     * @return ObraAutor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelObraAutor($Obra_id, $Autor_id)
    {
        if (($model = ObraAutor::findOne(['Obra_id' => $Obra_id, 'Autor_id' => $Autor_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Não existe ligação entre o Autor e Obra.');
    }

    #endregion

    //TODO Analítico

    #region Exemplar

    /**
     * Displays a single Exemplar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExemplarView($id)
    {
        if ((Yii::$app->user->can('verExemplares')))
        {
            return $this->renderAjax('obra/exemplar/view', ['model' => $this->findModelExemplar($id),]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Creates a new Exemplar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionExemplarCreate($idObra, $tipoObra)
    {
        if ((Yii::$app->user->can('inserirExemplares')))
        {

            $model = new Exemplar();

            $estatutoexemplarAll = ArrayHelper::map(Estatutoexemplar::find()->all(),'id','estatuto',['enctype' => 'multipart/form-data']);
            $tipoexemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);

            $exemplarCount = Exemplar::find()->count();
            if($exemplarCount == null) {$exemplarCount = 1;}
            else {$exemplarCount++;}

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> Um novo exemplar foi adicionado.");
                return $this->redirect(['cat/obra-full', 'id'=>$idObra]);
            }
            return $this->renderAjax('obra/exemplar/create',
                ['model' => $model, 'bibliotecaAll' => $bibliotecaAll, 'tipoexemplarAll' => $tipoexemplarAll,
                    'estatutoexemplarAll' => $estatutoexemplarAll,
                    'idObra'=>$idObra,'tipoObra'=>$tipoObra, 'exemplarCount'=> $exemplarCount]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Updates an existing Exemplar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExemplarUpdate($id, $tipoObra)
    {
        if ((Yii::$app->user->can('editarExemplares')))
        {
            $model = $this->findModelExemplar($id);

            $estatutoexemplarAll = ArrayHelper::map(Estatutoexemplar::find()->all(),'id','estatuto',['enctype' => 'multipart/form-data']);
            $tipoexemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> O exemplar com a cota: "<u>'.$model->cota .'</u>" e o código de barras: "<u>'.$model->codBarras.'</u>" foi atualizado.');
                return $this->redirect(['cat/obra-full', 'id' => $model->obra->id]);
            }

            return $this->renderAjax('obra/exemplar/update',
                ['model' => $model, 'bibliotecaAll' => $bibliotecaAll,
                    'tipoexemplarAll' => $tipoexemplarAll, 'tipoObra'=>$tipoObra,
                    'estatutoexemplarAll' => $estatutoexemplarAll]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Deletes an existing Exemplar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExemplarDelete($id)
    {
        if ((Yii::$app->user->can('eliminarExemplares')))
        {
            $model = Exemplar::findOne($id);

            if ($model->estado == 'nd' || $model->estado == 'estante') {
                $this->findModelExemplar($id)->delete();
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> Foi removido o exemplar com a cota: "<u>'.$model->cota .'</u>" e o código de barras: "<u>'.$model->codBarras.'</u>".');
            }
            else {
                Yii::$app->session->setFlash('error', '<strong>Informação:</strong> Só é possível remover exemplares no estado "Não Disponível" ou "Na Estante"');
            }

            return $this->redirect(['cat/obra-full', 'id'=> $model->obra->id]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionExemplarPedir($id)
    {
        if($model = Exemplar::findOne($id))
        {
            if($model->estado == 'estante')
            {
                //TODO Fazer pedido / MQTT

                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> Foi enviado um pedido de levantamento para o exemplar com a cota: 
                            "<u>'.$model->cota .'</u>" e o código de barras: "<u>'.$model->codBarras.'</u>"');

                return $this->redirect(['cat/obra-full', 'id'=> $model->obra->id]);
            }
            else
                {
                    Yii::$app->session->setFlash('warning', "<strong>Informação:</strong> Só é possivel enviar pedido de levantamento se o exemplar estiver na estante");
                }
        }else
            {
                return $this->redirect(['cat/obra-full', 'id'=> $model->obra->id]);
            }

        throw new NotFoundHttpException('Pedido de levantamento não disponível para o exemplar selecionado.');

    }

    /**
     * Finds the Exemplar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exemplar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelExemplar($id)
    {
        if (($model = Exemplar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Exemplar não encontrado.');
    }

    #endregion

    #region Autor
    /**
     * Displays a single Autor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAutorView($id)
    {
        if ((Yii::$app->user->can('acessoCatalogo')))
        {
            return $this->renderAjax('autor/view', ['model' => $this->findModelAutor($id),]);
        }

        throw new NotFoundHttpException('Exemplar não encontrado.');
    }

    public function actionAutorCreate()
    {
        if ((Yii::$app->user->can('acessoCatalogo')))
        {
            $model = new AutorForm();

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                $autor = $model->primeiroNome.' '.$model->segundoNome.' '.$model->apelido;
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O autor "'.$autor.'" foi adicionado com sucesso.');
                return $this->redirect(['cat/index']);
            }

            return $this->renderAjax('autor/create', ['model' => $model,]);
        }
        throw new NotFoundHttpException('Exemplar não encontrado.');
    }

    /**
     * Updates an existing Autor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAutorUpdate($id)
    {
        if ((Yii::$app->user->can('acessoCatalogo')))
        {
            $model = $this->findModelAutor($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $autor = '"'.$model->primeiroNome.' '.$model->segundoNome.' '.$model->apelido.
                    '" ('.Yii::$app->formatter->asDate($model->dataNasc, 'yyyy').')';
                Yii::$app->session->setFlash('success', '<strong>Informação:</strong> O autor '.$autor.' foi atualizado com sucesso.');
                return $this->redirect(['index']);
            }

            return $this->renderAjax('autor/update', ['model' => $model]);
        }
        throw new NotFoundHttpException('Exemplar não encontrado.');
    }

    /**
     * Deletes an existing Autor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAutorDelete($id)
    {
        if ((Yii::$app->user->can('acessoCatalogo')))
        {
            $autor = $this->findModelAutor($id);
            $oldAutor = $autor->primeiroNome.' '.$autor->segundoNome.' '.$autor->apelido;
            $count =$autor->getObras()->count();
            if($count == 0)
            {
                $this->findModelAutor($id)->delete();

                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> O autor "'.$oldAutor.' foi removido com sucesso.');

                return $this->redirect(['index']);

            }
            else{
                Yii::$app->session->setFlash('danger',
                    '<strong>Informação:</strong> Só é possível apagar os autores que não têm obras agregadas.<hr>
                        Autor: "'.$oldAutor.'"<br>Obras Agregadas: '.$count);

                return $this->redirect(['index']);
            }
        }
        throw new NotFoundHttpException('Exemplar não encontrado.');
    }

    /**
     * Finds the Autor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Autor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelAutor($id)
    {
        if (($model = Autor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Autor não encontrado.');
    }

    #endregion

    #region Colecao

    /**
     * Displays a single Colecao model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionColecaoView($id)
    {
        return $this->renderAjax('colecao/view', ['model' => $this->findModelColecao($id),]);
    }

    /**
     * Creates a new Colecao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionColecaoCreate()
    {
        $model = new Colecao();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> A coleção "'.$model->tituloColecao.'" foi adicionada com sucesso.');
            return $this->redirect(['cat', 'id' => $model->id]);
        }

        return $this->renderAjax('colecao/create', ['model' => $model,]);
    }

    /**
     * Updates an existing Colecao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionColecaoUpdate($id)
    {
        $model = $this->findModelColecao($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> A coleção "'.$model->tituloColecao.'" foi atualizada com sucesso.');
            return $this->redirect(['cat', 'id' => $model->id]);
        }

        return $this->renderAjax('colecao/update', ['model' => $model,]);
    }

    /**
     * Deletes an existing Colecao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionColecaoDelete($id)
    {
        $model = $this->findModelColecao($id);

        if($model->getObras()->count() == 0)
        {
            if($this->findModelColecao($id)->delete())
            {
                Yii::$app->session->setFlash('success','<strong>Informação:</strong> A coleção "'.$model->tituloColecao.'" foi apagada.');
                return $this->redirect(['index']);
            }

        }else
            {
                Yii::$app->session->setFlash('warning','<strong>Informação:</strong> Só é possivel apagar coleções sem obras agragadas<hr>Coleção: "'.$model->tituloColecao.'".'.'<br>Obras Agregadas: '.$model->getObras()->count());
                return $this->redirect(['index']);
            }

        return $this->redirect(['cat']);
    }

    /**
     * Finds the Colecao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Colecao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelColecao($id)
    {
        if (($model = Colecao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    #endregion

    #region Analticos

    //TODO

    #endregion
}