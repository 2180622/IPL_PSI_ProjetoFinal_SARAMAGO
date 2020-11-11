<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Obra]].
 *
 * @see Obra
 */
class ObraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Obra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Obra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
