<?php
namespace backend\controllers;

use app\models\ExemplarSearch;
use app\models\ObraSearch;
use backend\models\ObraForm;
use backend\models\ExemplarForm;
use common\models\Cdu;
use common\models\Colecao;
use common\models\Exemplar;
use common\models\Fundo;
use common\models\Obra;
use common\models\Tipoexemplar;
use common\models\Biblioteca;
use common\models\Estatutoexemplar;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

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
                            'view','view-full', 'create', 'update', 'delete',
                            'exemplar-index','exemplar-update','exemplar-view','exemplar-create','exemplar-delete',
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

    #region Obra / root
    /**
     * Lists all obra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout="minor";

        $obrasModel = Obra::find()->all();
        $exemplarModels = Exemplar::find()->all();
        $cduAll = ArrayHelper::map(Cdu::find()->all(),'id','designacao','codCdu',['enctype' => 'multipart/form-data']);
        $tiposExemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
        $colecaoAll = ArrayHelper::map(Colecao::find()->all(), 'id', 'tituloColecao', ['enctype' => 'multipart/form-data']);

        $searchModel = new ObraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',
            ['searchModel' => $searchModel, 'dataProvider' => $dataProvider,
                'obrasModel' => $obrasModel, 'cduAll'=>$cduAll,
                'tiposExemplarAll'=>$tiposExemplarAll, 'colecaoAll' => $colecaoAll]);
    }

    /**
     * Displays a single obra model in modal.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Displays a single obra full model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewFull($id)
    {
        $this->layout = 'minor';

        $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);
        //for ->actionExemplarView
        $totalExemplaresDaObra = Exemplar::find()->where('Obra_id='.$id)->count();
        $exemplarModels = Exemplar::find()->all();
        $searchModel = new ExemplarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('view-full', ['model' => $this->findModel($id), 'totalExemplaresDaObra' => $totalExemplaresDaObra,
            'searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'exemplarModels' => $exemplarModels, 'bibliotecaAll' => $bibliotecaAll]);
    }

    /**
     * Creates a new obra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObraForm();

        $cduAll = ArrayHelper::map(Cdu::find()->all(),'id','designacao','codCdu',['enctype' => 'multipart/form-data']);
        $colecaoAll = ArrayHelper::map(Colecao::find()->all(),'id','tituloColecao',['enctype' => 'multipart/form-data']);
        if(Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->createObra()) {
                Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O " . $model->titulo . " foi adicionado.");
                return $this->redirect(['view-full', 'id' => $model->id]);
            }
        }

        return $this->renderAjax('create', ['model' => $model, 'cduAll'=> $cduAll, 'colecaoAll' => $colecaoAll]);
    }

    /**
     * Updates an existing obra model.
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

        return $this->renderAjax('update', ['model' => $model]);
    }

    /**
     * Deletes an existing obra model.
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
     * Finds the obra model based on its primary key value.
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

        throw new NotFoundHttpException('Obra não encontrada.');
    }

    #endregion

    #region Exemplar
    /**
     * Lists all Exemplar models.
     * @return mixed
     */
    public function actionExemplarIndex()
    {
        $searchModel = new ExemplarSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('exemplar/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Exemplar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExemplarView($id)
    {
        return $this->renderAjax('exemplar/view', ['model' => $this->findModelExemplar($id),]);
    }

    /**
     * Creates a new Exemplar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionExemplarCreate()
    {
        $model = new ExemplarForm();

        $estatutoexemplarAll = ArrayHelper::map(Estatutoexemplar::find()->all(),'id','estatuto',['enctype' => 'multipart/form-data']);
        $tipoexemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
        $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);

        if ($model->load(Yii::$app->request->post()) && $model->createExemplar()) {
            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> Um novo exemplar foi adicionado.");
            return $this->redirect(['view-full', 'id' => $model->obra->id]);
        }
        return $this->renderAjax('exemplar/create', ['model' => $model, 'bibliotecaAll' => $bibliotecaAll, 'tipoexemplarAll' => $tipoexemplarAll, 'estatutoexemplarAll' => $estatutoexemplarAll]);
    }

    /**
     * Updates an existing Exemplar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExemplarUpdate($id)
    {
        $model = $this->findModelExemplar($id);

        $estatutoexemplarAll = ArrayHelper::map(Estatutoexemplar::find()->all(),'id','estatuto',['enctype' => 'multipart/form-data']);
        $tipoexemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);
        $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-full', 'id' => $model->obra->id]);
        }

        return $this->renderAjax('exemplar/update', ['model' => $model, 'bibliotecaAll' => $bibliotecaAll, 'tipoexemplarAll' => $tipoexemplarAll, 'estatutoexemplarAll' => $estatutoexemplarAll]);
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
        $model = Exemplar::findOne($id);
        if ($model->estado == 'nd' || $model->estado == 'estante') {
            $this->findModelExemplar($id)->delete();
        }
        else {
            Yii::$app->session->setFlash('error', "Erro ao remover o exemplar: Só é possível remover exemplares no estado 'Não disponível' ou 'Na estante' ");
        }

        return $this->redirect(['view-full', 'id' => $model->obra->id]);
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

    //TODO

    #endregion

    #region Analticos

    //TODO

    #endregion
}