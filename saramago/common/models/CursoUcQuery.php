<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CursoUc]].
 *
 * @see CursoUc
 */
class CursoUcQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CursoUc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CursoUc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
