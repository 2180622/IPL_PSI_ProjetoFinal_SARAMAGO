<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipoleitor".
 *
 * @property int $id Chave primária
 * @property string $estatuto Estatuto do leitor
 * @property string $tipo Tipo de leitor
 * @property int $nItens Quantidade de exemplares requisitáveis em sua posse
 * @property int $prazoDias Duração do empréstimo (em dias)
 * @property int $registoOpac Permissão para registo via Opac
 * @property string|null $notas Notas
 *
 * @property Leitor[] $leitors
 */
class Tipoleitor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipoleitor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estatuto', 'tipo'], 'required'],
            [['tipo'], 'string'],
            [['nItens', 'prazoDias', 'registoOpac'], 'integer'],
            [['estatuto', 'notas'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'estatuto' => 'Estatuto do leitor',
            'tipo' => 'Tipo de leitor',
            'nItens' => 'Quantidade de exemplares requisitáveis em sua posse',
            'prazoDias' => 'Duração do empréstimo (em dias)',
            'registoOpac' => 'Permissão para registo via Opac',
            'notas' => 'Notas',
        ];
    }

    /**
     * Gets query for [[Leitors]].
     *
     * @return \yii\db\ActiveQuery|LeitorQuery
     */
    public function getLeitors()
    {
        return $this->hasMany(Leitor::className(), ['TipoLeitor_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TipoleitorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoleitorQuery(get_called_class());
    }
}
