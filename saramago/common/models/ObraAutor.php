<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "obra_autor".
 *
 * @property int $Obra_id
 * @property int $Autor_id
 *
 * @property Autor $autor
 * @property Obra $obra
 */
class ObraAutor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obra_autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Obra_id', 'Autor_id'], 'required'],
            [['Obra_id', 'Autor_id'], 'integer'],
            [['Obra_id', 'Autor_id'], 'unique', 'targetAttribute' => ['Obra_id', 'Autor_id']],
            [['Autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::className(), 'targetAttribute' => ['Autor_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Obra_id' => 'Obra ID',
            'Autor_id' => 'Autor ID',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery|AutorQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::className(), ['id' => 'Autor_id']);
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
     * @return ObraAutorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ObraAutorQuery(get_called_class());
    }
}
