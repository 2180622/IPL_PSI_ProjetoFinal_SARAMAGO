<?php

namespace backend\models;

use common\models\AuthAssignment;
use common\models\AuthItem;
use common\models\Leitor;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * EquipaSearch represents the model behind the search form of `common\models\user`.
 */
class EquipaSearch extends User
{
    public $item_name;
    public $nome;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['item_name', 'string'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // all users except admin
        $query = User::find()
            ->leftJoin(AuthAssignment::tableName(), "user_id = id")
            ->where("item_name LIKE '%operador%'");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=> [
                'item_name' => [
                    'asc' => [AuthAssignment::tableName().'.item_name' => SORT_ASC],
                    'desc' => [AuthAssignment::tableName().'.item_name' => SORT_DESC],
                    'label' => 'Função'],
                'email' => [
                    'asc' => [User::tableName().'.item_name' => SORT_ASC],
                    'desc' => [User::tableName().'.item_name' => SORT_DESC],
                    'label' => 'E-mail'],
                'username' => [
                    'asc' => [User::tableName().'.username' => SORT_ASC],
                    'desc' => [User::tableName().'.username' => SORT_DESC],
                    'label' => 'Username'],
                'status' => [
                    'asc' => [User::tableName().'.username' => SORT_ASC],
                    'desc' => [User::tableName().'.username' => SORT_DESC],
                    'label' => 'Status'],

            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'item_name' => $this->item_name,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', AuthAssignment::tableName().'.item_name', $this->item_name]);

        return $dataProvider;
    }
}