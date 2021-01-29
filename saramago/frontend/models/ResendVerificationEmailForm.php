<?php


namespace frontend\models;

use Yii;
use common\models\User;
use yii\base\Model;

class ResendVerificationEmailForm extends Model
{
    /**
     * @var string
     */
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
                'filter' => ['status' => User::STATUS_INACTIVE],
                'message' => 'Não existe nenhum user com este email'
            ],
        ];
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail() //envia email quando o utilizador pede reenvio de email de confirmação
    {
        $user = User::findOne([
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE
        ]);

        if ($user === null) {
            return false;
        }

        Yii::$app->mailer->compose('resendEmailVerify-text', ['user' => $user])
            ->setFrom('saramagoipl@gmail.com')
            ->setTo($this->email)
            ->setSubject('Confirmar email')
            ->send();

        return true;
    }
}
