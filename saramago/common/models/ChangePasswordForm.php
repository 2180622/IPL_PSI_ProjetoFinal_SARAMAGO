<?php


namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ChangePassword
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @url https://github.com/mdmsoft/yii2-admin/blob/master/models/form/ChangePassword.php
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $retypePassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'retypePassword'], 'required'],
            [['oldPassword'], 'validatePassword'],
            [['newPassword'], 'string', 'min' => 6],
            [['newPassword'], 'compare', 'operator' => '!=','compareAttribute' => 'oldPassword'],
            [['retypePassword'], 'compare', 'compareAttribute' => 'newPassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => 'Password Atual',
            'newPassword' => 'Password Nova',
            'retypePassword' => 'Confirme a Password Nova',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->oldPassword)) {
            $this->addError('oldPassword', 'Password atual incorreta.');
        }
    }

    /**
     * Change password.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function change()
    {
        if ($this->validate()) {
            /* @var $user User */
            $user = Yii::$app->user->identity;
            $user->setPassword($this->newPassword);
            $user->generateAuthKey();

            if ($user->save()) {
                return true;
            }
        }

        return false;
    }
}