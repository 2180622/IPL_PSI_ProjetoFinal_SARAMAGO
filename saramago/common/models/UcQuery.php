<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Uc]].
 *
 * @see Uc
 */
class UcQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Uc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Uc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
