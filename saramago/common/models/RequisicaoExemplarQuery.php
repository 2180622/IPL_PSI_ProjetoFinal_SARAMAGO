<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[RequisicaoExemplar]].
 *
 * @see RequisicaoExemplar
 */
class RequisicaoExemplarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RequisicaoExemplar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RequisicaoExemplar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
