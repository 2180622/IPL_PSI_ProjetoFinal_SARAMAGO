<?php
namespace backend\models;

use yii\base\Model;

class ObraForm extends Model
{
    public function rules()
    {
        return [
            ['titulo', 'trim'],
        ];
    }
}