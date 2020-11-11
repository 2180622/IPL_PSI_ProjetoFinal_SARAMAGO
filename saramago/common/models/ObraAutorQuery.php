<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ObraAutor]].
 *
 * @see ObraAutor
 */
class ObraAutorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ObraAutor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ObraAutor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
