<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "biblioteca".
 *
 * @property int $id Chave primária
 * @property string $codBiblioteca Código/Sigla da biblioteca
 * @property string $nome Nome da biblioteca
 * @property string|null $notasOpac Nota para o OPAC
 * @property string|null $morada Morada da biblioteca
 * @property string|null $localidade Localidade da biblioteca
 * @property int|null $codPostal Código Postal
 * @property int $levantamento Permissão para levantamento na biblioteca
 *
 * @property Exemplar[] $exemplars
 * @property Leitor[] $leitors
 */
class Biblioteca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'biblioteca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codBiblioteca', 'nome'], 'required'],
            [['notasOpac'], 'string'],
            [['codPostal', 'levantamento'], 'integer'],
            [['codBiblioteca'], 'string', 'max' => 5],
            [['nome', 'morada', 'localidade'], 'string', 'max' => 255],
            [['codBiblioteca'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'codBiblioteca' => 'Código/Sigla da biblioteca',
            'nome' => 'Nome da biblioteca',
            'notasOpac' => 'Nota para o OPAC',
            'morada' => 'Morada da biblioteca',
            'localidade' => 'Localidade da biblioteca',
            'codPostal' => 'Código Postal',
            'levantamento' => 'Permissão para levantamento na biblioteca',
        ];
    }

    /**
     * Gets query for [[Exemplars]].
     *
     * @return \yii\db\ActiveQuery|ExemplarQuery
     */
    public function getExemplars()
    {
        return $this->hasMany(Exemplar::className(), ['Biblioteca_id' => 'id']);
    }

    /**
     * Gets query for [[Leitors]].
     *
     * @return \yii\db\ActiveQuery|LeitorQuery
     */
    public function getLeitors()
    {
        return $this->hasMany(Leitor::className(), ['Biblioteca_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return BibliotecaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BibliotecaQuery(get_called_class());
    }
}
