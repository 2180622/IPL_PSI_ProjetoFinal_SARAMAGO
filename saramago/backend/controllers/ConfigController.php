<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                            'entidade', 'bibliotecas','postos',
                            'equipa',
                            'tipoexemplar', 'estexemplar','cdu',
                            'estleitor','irregularidade','cursos',
                            'recibos',
                            'reservasopac','slidesopac',
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

    /**
     * Bibliotecas da entidade homepage.
     *
     * @return string
     */
    public function actionBibliotecas()
    {
        return $this->render('bibliotecas');
    }

    /**
     * Postos de Trabalho das bibliotecas homepage.
     *
     * @return string
     */
    public function actionPostos()
    {
        return $this->render('postos');
    }

    /**
     * Gestão dos logótipos homepage.
     *
     * @return string
     */
    public function actionlogotipos()
    {
        return $this->render('logotipos');
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
    public function actionReservasopac()
    {
        return $this->render('reservasopac');
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