<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Consultatreal]].
 *
 * @see Consultatreal
 */
class ConsultatrealQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Consultatreal[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Consultatreal|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
