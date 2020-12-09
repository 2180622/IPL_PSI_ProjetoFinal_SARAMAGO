<?php
namespace backend\models;

use common\models\AuthAssignment;
use common\models\Funcionario;
use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Leitor;
use common\models\Tipoleitor;
use DateTime;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class EquipaCreateForm extends Model
{
    public $id;
    public $user_id;
    public $Leitor_id;
    public $role;
    public $roleNova;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['user_id', 'trim'],
            ['user_id', 'integer'],

            ['Leitor_id', 'trim'],
            ['Leitor_id', 'integer'],

            ['role', 'trim'],
            ['role', 'string'],

            ['roleNova', 'trim'],
            ['roleNova', 'string'],
        ];
    }


    public function updateRole($id){
        if($this->validate()) {
            $user = User::findOne($id);
            $role = AuthAssignment::find()->where('user_id='.$user->id)->one();

            $this->role = $role->item_name;
            $roleNova= $this->roleNova;

            $role->item_name = $roleNova;
            $role->save();

            return true;
        }else{
            return false;
        }
    }

    public function associateOperador(){
        // TODO FIX THE " on clause " ambiguous
        if($this->validate()) {
            $leitores = Leitor::find()->all();
            ArrayHelper::map($leitores,'id','nome');
            $leitor = Leitor::findOne($leitores);
            $user = User::findOne($leitor->user_id);
            $Auth = AuthAssignment::find()->where("user_id = " . $user->id)->one();
            $role = $Auth->item_name;
            $this->role = $role;

            $Auth->item_name = $this->roleNova;
            $Auth->save();

            return true;
        }else{
            return false;
        }

    }

    public function findLeitor(){
        $leitores = Leitor::find()->all();

        foreach($leitores as $leitor){

        }
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function findModel($id)
    {
        if (($model = Leitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}