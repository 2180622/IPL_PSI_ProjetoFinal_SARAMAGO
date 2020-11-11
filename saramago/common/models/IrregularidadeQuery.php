<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Irregularidade]].
 *
 * @see Irregularidade
 */
class IrregularidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Irregularidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Irregularidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
