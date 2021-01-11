<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class ChangeUsernameForm extends Model
{
    public $oldUsername ;
    public $username;
    public $retypeUsername;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldUsername', 'username', 'retypeUsername'], 'required'],
            [['username'], 'string', 'min' => 5, 'max'=>10],
            [['retypeUsername'], 'string', 'min' => 5, 'max'=>10],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username em uso.'],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u'],
            [['username'], 'compare', 'operator' => '!=','compareAttribute' => 'oldUsername', 'message' => 'Username não pode ser igual ao atual.'],
            [['retypeUsername'], 'compare', 'compareAttribute' => 'username', 'message' => 'Username não coincide.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oldUsername' => 'Username Atual',
            'newUsername' => 'Username Novo',
            'retypeUsername' => 'Repita o Username Novo',
        ];
    }

    public function __construct()
    {
        $user = Yii::$app->user;
        $identity = $user->identity->username;

        $this->oldUsername = $identity;
    }

    public function change()
    {
        if($this->validate())
        {
            $user = User::findOne(Yii::$app->user->id);
            $user->setUsername($this->username);

            if ($user->save()) {
                return true;
            }
        }
        return false;
    }

}