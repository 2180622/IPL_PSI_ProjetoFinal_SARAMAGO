<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Sugestaoaquisicao]].
 *
 * @see Sugestaoaquisicao
 */
class SugestaoaquisicaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Sugestaoaquisicao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Sugestaoaquisicao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
