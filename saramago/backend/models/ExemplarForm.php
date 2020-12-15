<?php
namespace backend\models;

use yii\base\Model;

class ObraForm extends Model
{
    public function rules()
    {
        return [
            ['codBarras', 'trim'],
        ];
    }
}

<?php

namespace backend\models;

use yii\base\Model;

class ObraForm extends Model
{
    
    public function rules()
    {
        return [
            [['titulo', 'editor', 'ano', 'tipoObra', 'descricao', 'Cdu_id'], 'required'],
            [['resumo', 'tipoObra'], 'string'],
            [['ano', 'dataRegisto', 'dataAtualizado'], 'safe'],
            [['preco'], 'number'],
            [['Cdu_id', 'Colecao_id'], 'integer'],
            [['imgCapa', 'editor', 'descricao', 'assuntos'], 'string', 'max' => 255],
            [['titulo', 'local', 'edicao'], 'string', 'max' => 45],
            [['Cdu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cdu::className(), 'targetAttribute' => ['Cdu_id' => 'id']],
            [['Colecao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colecao::className(), 'targetAttribute' => ['Colecao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'imgCapa' => 'Imagem da Capa',
            'titulo' => 'Titulo da obra',
            'resumo' => 'Resumo da obra',
            'editor' => 'Editor',
            'ano' => 'Ano',
            'tipoObra' => 'Tipo de obra',
            'descricao' => 'Descrição da Obra',
            'local' => 'Local',
            'edicao' => 'Edição',
            'assuntos' => 'Assuntos',
            'preco' => 'Preço (€)',
            'dataRegisto' => 'Data registado',
            'dataAtualizado' => 'Data atualizado',
            'Cdu_id' => 'Chave estrangeira',
            'Colecao_id' => 'Chave estrangeira',
        ];
    }