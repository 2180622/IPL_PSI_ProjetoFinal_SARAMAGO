<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Tipoexemplar]].
 *
 * @see Tipoexemplar
 */
class TipoexemplarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tipoexemplar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Tipoexemplar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
