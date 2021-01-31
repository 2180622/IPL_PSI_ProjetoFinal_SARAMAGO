<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_ACTIVE,
        ]);

        if ($user == null) {
            return false;
        }
        
        $user->generatePasswordResetToken();
        $user->save();

        Yii::$app->mailer->compose('passwordResetToken-text', ['user' => $user])
            ->setFrom('saramagoipl@gmail.com')
            ->setTo($this->email)
            ->setSubject('Reposição de Password')
            ->send();

        return true;
    }
}
