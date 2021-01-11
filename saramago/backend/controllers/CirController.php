<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

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
                            'emprestimo',
                            'devolucao',
                            'renovacao',
                            'presencial',
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

    public function actionEmprestimo()
    {
        if ((Yii::$app->user->can('acessoCirculacao'))) {
            $this->layout="minor";

            return $this->render('emprestimo/index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }

    public function actionDevolucao()
    {
        if ((Yii::$app->user->can('acessoCirculacao'))) {
            $this->layout="minor";

            return $this->render('devolucao/index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');    
    }

    public function actionRenovacao()
    {
        if ((Yii::$app->user->can('acessoCirculacao'))) {
            $this->layout="minor";

            return $this->render('renovar/index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    public function actionPresencial()
    {
        if ((Yii::$app->user->can('acessoCirculacao'))) {
            $this->layout="minor";

            return $this->render('presencial/index');
        }
        throw new ForbiddenHttpException ('Não tem permissões para aceder à página');
    }

    #endregion

}