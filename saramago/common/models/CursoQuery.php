<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Curso]].
 *
 * @see Curso
 */
class CursoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Curso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Curso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
