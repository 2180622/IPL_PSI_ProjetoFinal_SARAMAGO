<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tipoleitor]].
 *
 * @see Tipoleitor
 */
class TipoleitorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tipoleitor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tipoleitor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
