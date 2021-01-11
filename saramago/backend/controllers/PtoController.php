<?php
namespace backend\controllers;

use app\models\ReservaspostoSearch;
use app\models\ReservaspostoHojeSearch;
use common\models\Biblioteca;
use common\models\Leitor;
use common\models\Postotrabalho;
use common\models\Reservasposto;
use http\Url;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PtoController extends Controller
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
                            'posto', 'posto-info','posto-reservas',
                            'reserva-create', 'reserva-view', 'reserva-update','reserva-conf'],
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

    #region Index /root
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout="minor";

        $bibliotecasCount = Biblioteca::find()->count();
        $postosCount = Postotrabalho::find()->count();

        $bibliotecasModel = Biblioteca::find()->all();
        $postosModel = Postotrabalho::find()->all();

        $reservasModel = Reservasposto::find()->all();

        $userRoleLogin = array_keys(Yii::$app->authManager->getRolesByUser(Yii::$app->user->id))[0];

        return $this->render('index', ['bibliotecasCount'=>$bibliotecasCount, 'postosCount'=>$postosCount,
            'bibliotecasModel'=>$bibliotecasModel, 'postosModel'=> $postosModel, 'userRoleLogin'=>$userRoleLogin,
            'reservas'=>$reservasModel]);
    }

    #endregion

    #region Posto de Trabalho
    /**
     * Displays a single Posto de Trabalho model.
     * @models common\models\Postotrabalho
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPostoInfo($id)
    {
        if (($model = Postotrabalho::findOne($id)) !== null) {
            return $this->renderAjax('posto-info', ['model' => $model]);
        }
        throw new NotFoundHttpException('O Posto de Trabalho não existe');

    }

    /**
     * Lists all Reservasposto models.
     * @return mixed
     */

    public function actionPostoReservas($idPosto)
    {
        $searchModelHoje = new ReservaspostoHojeSearch();
        $dataProviderHoje = $searchModelHoje->search(Yii::$app->request->queryParams);

        $searchModel = new ReservaspostoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $reservas = Reservasposto::find()->all();

        return $this->renderAjax('posto-reservas',
            ['searchModelHoje' => $searchModelHoje, 'dataProviderHoje' => $dataProviderHoje,
            'searchModel' => $searchModel, 'dataProvider' => $dataProvider,
            'reservas'=>$reservas]);

    }
    #endregion

    #region Reservas

    /**
     * Creates a new Reservasposto model on a single Posto de Trabalho model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionReservaCreate($idPosto)
    {
        $model = new Reservasposto();

        $totalLugaresCount = Postotrabalho::findOne($idPosto)->totalLugares;

        $totalLugares = array();
        for ($i = 1; $i <= $totalLugaresCount; $i++) {
            $totalLugares[$i]=$i;
        }

        $listLeitores = Leitor::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> Foi reservado o lugar <u>' . $model->lugar . '</u> para <u>' .
                Yii::$app->formatter->asDate($model->dataReserva, 'full') . '</u>, em nome de <u>' .
                $model->leitor->nome . '</u> [@' . $model->leitor->user->username . '], em <u>' .
                $model->postoTrabalho->designacao . ' (' . $model->postoTrabalho->biblioteca->codBiblioteca . ')</u>.');

            return $this->redirect(['index', '#' => $model->postoTrabalho->id . '-' . $model->id]);
        }

        return $this->renderAjax('reserva-create', ['model' => $model,
            'totalLugares' => $totalLugares, 'listLeitores'=>$listLeitores,
            'idPosto'=>$idPosto]);
    }

    /**
     * Displays a single Reservasposto model on single Posto de Trabalho model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReservaView($id)
    {
        return $this->renderAjax('reserva-view', ['model' => $this->findModelReservasposto($id)]);
    }

    /**
     * Updates an existing Reservasposto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReservaUpdate($id)
    {
        $model = $this->findModelReservasposto($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                '<strong>Informação:</strong> Foi atualizada a informação da reserva nº <u>'.$model->id.'</u>.');
            return $this->redirect(['index', '#' => $model->postoTrabalho->id . '-' . $model->id]);
        }

        return $this->renderAjax('reserva-update', ['model' => $model,]);

    }

    /**
     * Updates an existing Reservasposto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReservaConf($id)
    {
        $model = $this->findModelReservasposto($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if($model->estadoReserva == 'concluido')
            {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> A reserva nº: <u>'.$model->id.'</u> foi <u>Concluída</u> com sucesso.');

            }
            elseif($model->estadoReserva == 'cancelado')
            {
                Yii::$app->session->setFlash('success',
                    '<strong>Informação:</strong> A reserva nº: <u>'.$model->id.'</u> foi <u>Cancelada</u> com sucesso.');
            }

           return $this->redirect(['index', '#' => $model->postoTrabalho->id . '-' . $model->id]);
        }

        return $this->renderAjax('reserva-conf', ['model' => $model,]);

    }

    /**
     * Finds the Reservasposto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservasposto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelReservasposto($id)
    {
        if (($model = Reservasposto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    #endregion

}