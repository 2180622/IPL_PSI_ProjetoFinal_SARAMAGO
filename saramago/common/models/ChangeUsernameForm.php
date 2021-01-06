<?php

namespace common\models;

use Yii;

class ChangeUsernameForm extends User
{
    public $oldUsername ;
    public $newUsername;
    public $retypeUsername;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldUsername', 'newUsername', 'retypeUsername'], 'required'],
            [['newUsername'], 'string', 'min' => 5],
            [['newUsername'], 'compare', 'operator' => '!=','compareAttribute' => 'oldUsername'],
            [['retypeUsername'], 'compare', 'compareAttribute' => 'newUsername'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oldUsername' => 'Username Atual',
            'newUsername' => 'Username Nova',
            'retypeUsername' => 'Username Nova',
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
            $user->setUsername($this->$newUsername);
            $user->save();

            return true;

        } else {
            return false;
        }

    }

}