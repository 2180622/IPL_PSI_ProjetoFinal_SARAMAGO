<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoirregularidade".
 *
 * @property int $id Chave primária
 * @property string $irregularidade Tipo de obra entregue
 * @property int $diasBloqueio Duração do bloqueio (em dias)
 * @property int $diasAtivacao Ativação do bloqueio (em dias)
 *
 * @property Irregularidade[] $irregularidades
 */
class Tipoirregularidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoirregularidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['irregularidade'], 'required'],
            [['irregularidade'], 'string'],
            [['diasBloqueio', 'diasAtivacao'], 'integer'],
            [['irregularidade'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'irregularidade' => 'Tipo de obra entregue',
            'diasBloqueio' => 'Duração do bloqueio (em dias)',
            'diasAtivacao' => 'Ativação do bloqueio (em dias)',
        ];
    }

    /**
     * Gets query for [[Irregularidades]].
     *
     * @return \yii\db\ActiveQuery|IrregularidadeQuery
     */
    public function getIrregularidades()
    {
        return $this->hasMany(Irregularidade::className(), ['TipoIrregularidade_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TipoirregularidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoirregularidadeQuery(get_called_class());
    }
}
