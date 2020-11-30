<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Config;
use yii\helpers\Url;

/**
 * ConfigSearch represents the model behind the search form of `common\models\Config`.
 */
class Entidade extends Config
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [    
            [['info', 'key', 'value'], 'safe'],
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
        $query = Config::find()->where(['like', 'key', 'entidade_']);

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
        ]);

        $query->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }

    #region Entidade

    /**
     * @return string|null
     */
    public static function codPostal()
    {
        $codPostal = Config::find()->where(['like', 'key', 'entidade_codPostal'])->one();

        return $codPostal->value;
    }

    /**
     * @return string|null
     */
    public static function designacao()
    {
        $designacao = Config::find()->where(['like', 'key', 'entidade_designacao'])->one();

        return $designacao->value;
    }

    /**
     * @return string|null
     */
    public static function localidade()
    {
        $localidade = Config::find()->where(['like', 'key', 'entidade_localidade'])->one();

        return $localidade->value;
    }

    /**
     * @return string|null
     */
    public static function morada()
    {
        $morada = Config::find()->where(['like', 'key', 'entidade_morada'])->one();

        return $morada->value;
    }

    /**
     * @return string|null
     */
    public static function nipc()
    {
        $nipc = Config::find()->where(['like', 'key', 'entidade_nipc'])->one();

        return $nipc->value;
    }

    /**
     * @return string|null
     */
    public static function sigla()
    {
        $sigla = Config::find()->where(['like', 'key', 'entidade_sigla'])->one();

        return $sigla->value;
    }

    #endregion
}
