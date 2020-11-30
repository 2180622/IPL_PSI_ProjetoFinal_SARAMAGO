<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "estatutoexemplar".
 *
 * @property int $id Chave primária
 * @property string $estatuto Designação do estatuto do exemplar
 * @property int $prazo Dias do prazo de empréstimo
 *
 * @property Exemplar[] $exemplars
 */
class Estatutoexemplar extends \yii\db\ActiveRecord
{

    const ID_NORMAL = 1;
    const ID_CURTO = 2;
    const ID_DIARIO = 3;
    const ID_NREQ = 4;

    const PRAZO_NORMAL = null;
    const PRAZO_CURTO = 3;
    const PRAZO_DIARIO = 1;
    const PRAZO_NREQ = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estatutoexemplar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatuto'], 'required'],
            [['prazo'], 'integer'],
            [['estatuto'], 'string', 'max' => 255],
            [['prazo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'estatuto' => 'Designação do estatuto do exemplar',
            'prazo' => 'Dias do prazo de empréstimo',
        ];
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['EstatutoExemplar_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return EstatutoexemplarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstatutoexemplarQuery(get_called_class());
    }


    /**
     * @param $id
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function reset($id)
    {
        if($id == self::ID_NORMAL)
        {
            Yii::$app->db->createCommand()->update(self::tableName(), ['prazo' => self::PRAZO_NORMAL], 'id = '. $id)->execute();
        }
        elseif($id == self::ID_CURTO)
        {
            Yii::$app->db->createCommand()->update(self::tableName(), ['prazo' => self::PRAZO_CURTO], 'id = ' . $id)->execute();
        }
        elseif($id == self::ID_DIARIO)
        {
            Yii::$app->db->createCommand()->update(self::tableName(), ['prazo' => self::PRAZO_DIARIO], 'id = ' . $id)->execute();
        }
        elseif($id == self::ID_NREQ)
        {
            Yii::$app->db->createCommand()->update(self::tableName(), ['prazo' => self::PRAZO_NREQ], 'id = ' . $id)->execute();
        }
        return true;
    }


}
