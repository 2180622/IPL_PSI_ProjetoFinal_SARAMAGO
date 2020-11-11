<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Fundo]].
 *
 * @see Fundo
 */
class FundoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Fundo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Fundo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
