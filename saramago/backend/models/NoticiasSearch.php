<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Noticias;

/**
 * NoticiasSearch represents the model behind the search form of `common\models\Noticias`.
 */
class NoticiasSearch extends Noticias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['interface', 'dataVisivel', 'dataExpiracao', 'autor','assunto', 'conteudo'], 'safe'],
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

    public function __construct($config = [])
    {
        parent::__construct($config);
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
        $query = Noticias::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'dataVisivel' => $this->dataVisivel,
            'dataExpiracao' => $this->dataExpiracao,
            'dataRegisto'=>$this->dataRegisto,
            'assunto' => $this->assunto,
        ]);

        $query->andFilterWhere(['like', 'interface', $this->interface])
            ->andFilterWhere(['like', 'autor', $this->autor])
            ->andFilterWhere(['like', 'conteudo', $this->conteudo]);

        return $dataProvider;
    }
}
