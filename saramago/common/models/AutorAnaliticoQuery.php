<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[AutorAnalitico]].
 *
 * @see AutorAnalitico
 */
class AutorAnaliticoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AutorAnalitico[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AutorAnalitico|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
