<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Analitico]].
 *
 * @see Analitico
 */
class AnaliticoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Analitico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Analitico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
