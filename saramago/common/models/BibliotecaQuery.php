<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Biblioteca]].
 *
 * @see Biblioteca
 */
class BibliotecaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Biblioteca[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Biblioteca|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
