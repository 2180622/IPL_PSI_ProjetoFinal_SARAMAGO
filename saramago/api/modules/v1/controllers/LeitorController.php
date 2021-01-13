<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class LeitorController extends ActiveController
{

    public $modelClass = 'common\models\Leitor';

    public function actionIndex()
    {
        return $this->render('site/index');
    }

}