<?php
namespace backend\controllers;

use app\models\ConsultaTRealSearch;
use backend\models\DevolucaoForm;
use backend\models\EmprestimoForm;
use backend\models\RenovarForm;
use common\models\Biblioteca;
use common\models\Config;
use common\models\Consultatreal;
use common\models\Exemplar;
use common\models\Leitor;
use app\models\TransferenciasSearch;
use common\models\Requisicao;
use common\models\Tipoexemplar;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class CirController extends Controller
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
                        'actions' => [
                            'logout', 'index',
                            'emprestimo','fechar-sessao',
                            'devolucao',
                            'renovacao',
                            'presencial',
                            'transferencias',
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if ((Yii::$app->user->can('acessoCirculacao'))) {
            $this->layout="minor";

            return $this->render('index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    #region Circulação

    #region Empréstimo

    public function actionEmprestimo($leitor=null)
    {
        if ((Yii::$app->user->can('acessoCirculacao')))
        {
            $requisitados = null;

            //leitor
            if(strlen($leitor) >= '1') {
                $leitor = Leitor::find()
                    ->select([])
                    ->join("left join", "user", "user.id = user_id")
                    ->where(['user.status' => '10'])
                    ->andWhere(['or', ['leitor.codBarras' => $leitor], ['user.username' => $leitor]])
                    ->one();

                if($leitor == null)
                {
                    $leitor = '404';
                }
                else
                    {
                        $session = Yii::$app->session;
                        if(!$session->has('requisitados'))
                        {
                            $session->set('requisitados',[]);
                        }
                        $reqSession = $session->get('requisitados');
                    }
            }

            $emprestimoModel = new EmprestimoForm;

            if (Yii::$app->request->isAjax && $emprestimoModel->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($emprestimoModel);
            }
            elseif($emprestimoModel->load(Yii::$app->request->post()))
            {
                $emp = $emprestimoModel->create();

                if($emp == 'SARAMAGO400')
                {Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> O exemplar submetido não está nas condições de ser emprestado. Verifique o seu estado ou estatuto.");}
                elseif($emp == 'SARAMAGO403')
                {Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> O exemplar submetido encontra-se reservado para outra pessoa.");}
                elseif($emp == 'SARAMAGO401')
                {Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> O leitor atingiu o limite de quantidade de exemplares. Verifique o seu estatuto");}
                else
                {
                    $reqSession[]=$emp;
                    Yii::$app->session->setFlash('success', "<strong>Informação:</strong> Empréstimo efetuado com sucesso!");
                }

                $session->set('requisitados',$reqSession);

                foreach ($session->get('requisitados') as $requisitado)
                {
                    $req = Requisicao::findOne($requisitado);
                    $requisitados[] = strtoupper($req->exemplar->obra->titulo).'. ('.$req->exemplar->obra->ano.') | Dta. Devolução: '.Yii::$app->formatter->asDate($req->entregaPrevista);
                }
            }
            $this->layout="minor";

            return $this->render('emprestimo/index', ['leitor'=> $leitor, 'emprestimoModel'=> $emprestimoModel, 'requisitados'=>$requisitados]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }

    public function actionFecharSessao()
    {
        $reciboEmprestimo = Config::find()->where(['like','key', "recibo_emprestimo"])->limit('1')->one();

        $session = Yii::$app->session;

        $req = $session->get('requisitados');

        if($reciboEmprestimo->value == 1 && ($req != [] || $req != null))
        {
            //TODO RECIBOS -> via $req
        }

        $session->remove('requisitados');

        return $this->redirect('emprestimo');
    }

    #endregion

    public function actionDevolucao($exemplar=null)
    {
        if ((Yii::$app->user->can('acessoCirculacao')))
        {
            $estadoExemplar = null;

            if(strlen($exemplar) >= '1')
            {
                $exemplar = Exemplar::find()->select([])->where(['codBarras' => $exemplar])->one();

                if($exemplar == null)
                {
                    $exemplar = '404';
                }
                else
                    {
                        $model = new DevolucaoForm();
                        $estado = $model->run($exemplar->id);

                        if($estado == 'SARAMAGO400')
                        {
                            $exemplar = '400';
                        }
                        else{

                            $estadoExemplar = $estado;

                            Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O exemplar foi devolvido com sucesso.");
                        }
                    }
            }

            $this->layout="minor";

            return $this->render('devolucao/index',['exemplar'=>$exemplar, 'estadoExemplar'=> $estadoExemplar]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }

    public function actionRenovacao($exemplar=null)
    {
        if ((Yii::$app->user->can('acessoCirculacao')))
        {
            if(strlen($exemplar) >= '1')
            {
                $codBarras = $exemplar;
                $exemplar = Exemplar::find()->select([])->where(['codBarras' => $exemplar])->one();
                if($exemplar == null)
                {
                    $exemplar = '404';
                }
                else
                    {
                        if($exemplar->estado != Exemplar::ESTADO_EMPRESTADO) {$exemplar = '400';}
                        else
                            {
                                $renovarForm = new RenovarForm();
                                $estado = $renovarForm->renovar($codBarras);
                                if($estado == true)
                                {
                                    Yii::$app->session->setFlash('success', "<strong>Informação:</strong> O exemplar foi renovado com sucesso.");
                                }else
                                    {
                                        Yii::$app->session->setFlash('danger', "<strong>Informação:</strong> O exemplar não foi renovado por possuir reservas.");
                                    }
                            }
                    }
            }

            $this->layout="minor";

            return $this->render('renovar/index', ['exemplar'=>$exemplar]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    #region Presencial
    public function actionPresencial()
    {
        if ((Yii::$app->user->can('acessoCirculacao')))
        {
            $searchModel = new ConsultaTRealSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $this->layout="minor";

            return $this->render('presencial/index',['searchModel' => $searchModel, 'dataProvider' => $dataProvider,]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    /**
     * Creates a new ConsultaTReal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPresencialCreate()
    {
        $model = new ConsultaTReal();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Displays a single ConsultaTReal model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPresencialView($id)
    {
        return $this->render('view', [
            'model' => $this->findModelPresencial($id),
        ]);
    }

    /**
     * Updates an existing ConsultaTReal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPresencialUpdate($id)
    {
        $model = $this->findModelPresencial($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing ConsultaTReal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPresencialDelete($id)
    {
        $this->findModelPresencial($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConsultaTReal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConsultaTReal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelPresencial($id)
    {
        if (($model = ConsultaTReal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    #endregion

    #endregion

    #region Transferências
    public function actionTransferencias()
    {
        if ((Yii::$app->user->can('acessoCirculacao')))
        {
            $bibliotecaAll = ArrayHelper::map(Biblioteca::find()->all(),'id','nome',['enctype' => 'multipart/form-data']);
            $tipoExemplarAll = ArrayHelper::map(Tipoexemplar::find()->all(),'id','designacao','tipo',['enctype' => 'multipart/form-data']);

            $searchModel = new TransferenciasSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $this->layout="minor";

            return $this->render('transferencias/index',
                ['dataProvider'=>$dataProvider, 'searchModel'=>$searchModel,
                    'bibliotecaAll' => $bibliotecaAll,'tipoExemplarAll'=>$tipoExemplarAll
                ]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }
    #endregion

}