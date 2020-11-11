<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Materialav]].
 *
 * @see Materialav
 */
class MaterialavQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Materialav[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Materialav|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
