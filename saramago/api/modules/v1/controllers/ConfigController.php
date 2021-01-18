<?php

namespace api\modules\v1\controllers;

use common\models\Config;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use Yii;
use yii\web\Response;

class ConfigController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        $config = Config::find()
            ->select('key, value')
            ->all();

        return $config;

    }

    #region Entidade

    public function actionEntidade()
    {
        //TODO
    }

    public function actionEntidadeUpdate($id)
    {
        //TODO
    }

    public function actionEntidadeReset($id)
    {
        //TODO
    }

    #endregion

    #region Bibliotecas

    public function actionBibliotecas($id)
    {
        //TODO
    }

    public function actionBibliotecasView($id)
    {
        //TODO
    }

    public function actionBibliotecasCreate($id)
    {
        //TODO
    }

    public function actionBibliotecasUpdate($id)
    {
        //TODO
    }

    public function actionBibliotecasDelete($id)
    {
        //TODO
    }

    #endregion

    #region Postos
    public function actionPostos()
    {

        //TODO
    }

    public function actionPostosView($id)
    {
        //TODO
    }

    public function actionPostosCreate($id)
    {
        //TODO
    }

    public function actionPostosDelete($id)
    {
        //TODO
    }

    #endregion

    #region Logotipos
    public function actionLogotipos()
    {
        //TODO
    }


    public function actionLogotiposView($id)
    {
        //TODO
    }

    public function actionLogotiposReset($id)
    {

    }


    #endregion

    #region Noticias
    public function actionNoticias()
    {

    }

    #endregion

    #region Gestão Equipa()
    public function actionEquipa()
    {

    }
    #endregion

    #region Estatutos dos Exemplares
    public function actionEste()
    {

    }

    #endregion

}