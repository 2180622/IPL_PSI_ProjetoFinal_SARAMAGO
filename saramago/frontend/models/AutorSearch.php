<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Autor;

/**
 * AutorSearch represents the model behind the search form of `common\models\Autor`.
 */
class AutorSearch extends Autor
{
    public $pesquisaGeral;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['primeiroNome', 'pesquisaGeral', 'segundoNome', 'apelido', 'tipo', 'bibliografia', 'dataNasc', 'nacionalidade', 'orcid'], 'safe'],
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
        $query = Autor::find();

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

        $query->orFilterWhere(['like', 'primeiroNome', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'segundoNome', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'apelido', $this->pesquisaGeral])
            ->orFilterWhere(['like', "concat(primeiroNome,' ',segundoNome,'',apelido)", $this->pesquisaGeral])
            ->orFilterWhere(['like', 'tipo', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'bibliografia', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'nacionalidade', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'orcid', $this->pesquisaGeral]);

        return $dataProvider;
    }
}
