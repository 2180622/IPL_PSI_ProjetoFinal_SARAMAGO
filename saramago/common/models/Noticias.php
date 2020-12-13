<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id Chave primária
 * @property string $interface Interface onde será apresentada
 * @property string $dataVisivel Data visível
 * @property string|null $dataExpiracao Data da expiração
 * @property string $autor Autor
 * @property string $assunto Assunto
 * @property string $conteudo Conteúdo
 * @property string $dataRegisto Data registo da notícia
 */
class Noticias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['interface', 'autor', 'assunto', 'conteudo', 'dataVisivel'], 'required'],
            [['interface', 'assunto', 'conteudo'], 'string'],
            [['dataRegisto'], 'safe'],
            [['autor'], 'string', 'max' => 255],

            ['dataExpiracao', 'default', 'value' => null],
            ['dataExpiracao', 'compare', 'compareAttribute' => 'dataVisivel', 'operator' => '>=', 'enableClientValidation' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'interface' => 'Interface onde será apresentada',
            'dataVisivel' => 'Data visível',
            'dataExpiracao' => 'Data da expiração',
            'autor' => 'Autor',
            'assunto' => 'Assunto',
            'conteudo' => 'Conteúdo',
            'dataRegisto' => 'Data registo da notícia',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NoticiasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NoticiasQuery(get_called_class());
    }
}