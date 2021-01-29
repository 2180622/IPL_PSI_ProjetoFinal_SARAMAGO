<?php
namespace frontend\controllers;

use Yii;
use common\models\ChangePasswordForm;
use common\models\User;
use common\models\Leitor;
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
class ContaController extends Controller
{

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
                            'password',
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

    public function actionPassword()
    {
        if ((Yii::$app->user->can('acessoFrontend'))) {    

            $PasswordModel = new ChangePasswordForm();

            if (Yii::$app->request->isAjax && $PasswordModel->load(Yii::$app->request->post()))
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($PasswordModel);
            }
            elseif($PasswordModel->load(Yii::$app->request->post())&& $PasswordModel->change()) {
                Yii::$app->session->setFlash('success',
                    "<strong>Informação:</strong> A password foi alterada com sucesso!");
                return $this->redirect(['/']);
            }
            return $this->render('password',['model' => $PasswordModel]);
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }


}