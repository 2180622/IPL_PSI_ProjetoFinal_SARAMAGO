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
            [['estatuto', 'prazo'], 'required'],
            [['prazo'], 'integer'],
            [['estatuto'], 'string', 'max' => 255],
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
}
