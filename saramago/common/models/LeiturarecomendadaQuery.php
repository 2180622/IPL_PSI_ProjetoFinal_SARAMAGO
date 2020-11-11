<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Leiturarecomendada]].
 *
 * @see Leiturarecomendada
 */
class LeiturarecomendadaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Leiturarecomendada[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Leiturarecomendada|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
