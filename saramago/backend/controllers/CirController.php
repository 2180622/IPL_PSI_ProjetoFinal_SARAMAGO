<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        $this->layout="minor";
        return $this->render('index');
    }

    #region Circulação

    public function actionEmprestimo()
    {
        $this->layout="minor";

        return $this->render('emprestimo/index');
    }

    public function actionDevolucao()
    {
        $this->layout="minor";

        return $this->render('devolucao/index');
    }

    public function actionRenovacao()
    {
        $this->layout="minor";

        return $this->render('renovar/index');
    }

    public function actionPresencial()
    {
        $this->layout="minor";

        return $this->render('presencial/index');
    }

    #endregion

}