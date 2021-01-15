<?php

namespace api\modules\v1\controllers;

use common\models\Leitor;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class LeitorController extends ActiveController
{

    public $modelClass = 'common\models\Leitor';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

}