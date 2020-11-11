<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "irregularidade".
 *
 * @property int $id Chave primária
 * @property string $dataInicial Data inicial do bloqueio
 * @property string $dataFinal Data final do bloqueio
 * @property int $Leitor_id Chave estrangeira
 * @property int $TipoIrregularidade_id
 *
 * @property Leitor $leitor
 * @property Tipoirregularidade $tipoIrregularidade
 */
class Irregularidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'irregularidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataInicial', 'dataFinal'], 'safe'],
            [['dataFinal', 'Leitor_id', 'TipoIrregularidade_id'], 'required'],
            [['Leitor_id', 'TipoIrregularidade_id'], 'integer'],
            [['Leitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']],
            [['TipoIrregularidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoirregularidade::className(), 'targetAttribute' => ['TipoIrregularidade_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'dataInicial' => 'Data inicial do bloqueio',
            'dataFinal' => 'Data final do bloqueio',
            'Leitor_id' => 'Chave estrangeira',
            'TipoIrregularidade_id' => 'Tipo Irregularidade ID',
        ];
    }

    /**
     * Gets query for [[Leitor]].
     *
     * @return \yii\db\ActiveQuery|LeitorQuery
     */
    public function getLeitor()
    {
        return $this->hasOne(Leitor::className(), ['id' => 'Leitor_id']);
    }

    /**
     * Gets query for [[TipoIrregularidade]].
     *
     * @return \yii\db\ActiveQuery|TipoirregularidadeQuery
     */
    public function getTipoIrregularidade()
    {
        return $this->hasOne(Tipoirregularidade::className(), ['id' => 'TipoIrregularidade_id']);
    }

    /**
     * {@inheritdoc}
     * @return IrregularidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IrregularidadeQuery(get_called_class());
    }
}
