<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "monografia".
 *
 * @property int $id Chave primária
 * @property string|null $volume Número do Volume
 * @property int $paginas Numero de páginas
 * @property int $isbn International Standard Book Number (ISBN-10/ISBN-13)
 * @property int $Obra_id Chave estrangeira
 *
 * @property Obra $obra
 */
class Monografia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'monografia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paginas', 'isbn', 'Obra_id'], 'required'],
            [['paginas', 'isbn', 'Obra_id'], 'integer'],
            [['volume'], 'string', 'max' => 45],
            [['Obra_id'], 'exist', 'skipOnError' => false, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'volume' => 'Número do Volume',
            'paginas' => 'Numero de páginas',
            'isbn' => 'International Standard Book Number (ISBN-10/ISBN-13)',
            'Obra_id' => 'Chave estrangeira',
        ];
    }

    /**
     * Gets query for [[Obra]].
     *
     * @return \yii\db\ActiveQuery|ObraQuery
     */
    public function getObra()
    {
        return $this->hasOne(Obra::className(), ['id' => 'Obra_id']);
    }

    /**
     * {@inheritdoc}
     * @return MonografiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MonografiaQuery(get_called_class());
    }
}
