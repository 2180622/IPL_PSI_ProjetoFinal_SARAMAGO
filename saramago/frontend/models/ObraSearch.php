<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Obra;

/**
 * ObraSearch represents the model behind the search form of `common\models\obra`.
 */
class ObraSearch extends Obra
{
    public $pesquisaGeral;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Cdu_id', 'Colecao_id'], 'integer'],
            [['imgCapa', 'pesquisaGeral', 'titulo', 'resumo', 'editor', 'ano', 'tipoObra', 'descricao', 'local', 'edicao', 'assuntos', 'dataRegisto', 'dataAtualizado'], 'safe'],
            [['preco'], 'number'],
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
        $query = obra::find()->joinWith('autors');
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

        $query->orFilterWhere(['like', 'titulo', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'resumo', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'editor', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'tipoObra', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'descricao', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'local', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'edicao', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'assuntos', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'preco', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'primeiroNome', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'segundoNome', $this->pesquisaGeral])
            ->orFilterWhere(['like', 'apelido', $this->pesquisaGeral])
            /*->andFilterWhere(['like', 'tituloColecao', $this->colecao->tituloColecao])*/;

        return $dataProvider;
    }
}
