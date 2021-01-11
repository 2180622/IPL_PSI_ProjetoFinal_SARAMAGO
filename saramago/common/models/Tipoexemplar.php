<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoexemplar".
 *
 * @property int $id Chave primária
 * @property string $designacao Designação do tipo de exemplar
 * @property string $tipo Grupo característico do tipo de exemplar
 *
 * @property Exemplar[] $exemplars
 */
class Tipoexemplar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoexemplar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['designacao', 'tipo'], 'required'],
            [['tipo'], 'string', 'max' => 45],
            [['designacao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'designacao' => 'Designação do tipo de exemplar',
            'tipo' => 'Grupo característico do tipo de exemplar',
        ];
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['TipoExemplar_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TipoexemplarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoexemplarQuery(get_called_class());
    }
}
