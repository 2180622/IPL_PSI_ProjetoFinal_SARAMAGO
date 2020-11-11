<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Colecao]].
 *
 * @see Colecao
 */
class ColecaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Colecao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Colecao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
