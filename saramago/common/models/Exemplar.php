<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "exemplar".
 *
 * @property int $id Chave primária
 * @property string $cota Cota
 * @property string $codBarras Código de Barras
 * @property int $suplemento Exemplar suplemento da obra
 * @property string $estado Estado do exemplar
 * @property string|null $notaInterna Nota interna referente ao exemplar
 * @property int $Biblioteca_id Chave estrangeira
 * @property int $EstatutoExemplar_id Chave estrangeira
 * @property int $TipoExemplar_id Chave estrangeira
 * @property int $Obra_id
 * @property int|null $Fundo_id
 *
 * @property Consultatreal[] $consultatreals
 * @property Biblioteca $biblioteca
 * @property Estatutoexemplar $estatutoExemplar
 * @property Obra $obra
 * @property Tipoexemplar $tipoExemplar
 * @property Fundo $fundo
 * @property Requisicao[] $requisicaos
 * @property Reserva[] $reservas
 */
class Exemplar extends \yii\db\ActiveRecord
{
    const ESTADO_ARRUMACAO = 'arrumacao';
    const ESTADO_ESTANTE = 'estante';
    const ESTADO_QUARENTENA = 'quarentena';
    const ESTADO_PERDIDO = 'perdido';
    const ESTADO_RESERVADO = 'reservado';
    const ESTADO_EMPRESTADO = 'emprestado';
    const ESTADO_TRANSFERENCIA = 'transferencia';
    const ESTADO_ND = 'nd';

    const ESTADO = [
        self::ESTADO_ARRUMACAO => 'Em Arrumação...',
        self::ESTADO_ESTANTE =>'Na Estante',
        self::ESTADO_QUARENTENA =>'Em Quarentena',
        self::ESTADO_PERDIDO =>'Perdido',
        self::ESTADO_RESERVADO=>'Reservado',
        self::ESTADO_EMPRESTADO =>'Emprestado',
        self::ESTADO_TRANSFERENCIA =>'Transferência',
        self::ESTADO_ND =>'Não Disponível'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exemplar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cota', 'codBarras', 'estado', 'Biblioteca_id', 'EstatutoExemplar_id', 'TipoExemplar_id', 'Obra_id'], 'required'],
            [['suplemento', 'Biblioteca_id', 'EstatutoExemplar_id', 'TipoExemplar_id', 'Obra_id'], 'integer'],
            [['estado'], 'string'],
            [['cota'], 'string', 'max' => 45],
            [['codBarras'], 'string', 'max' => 13],
            [['notaInterna'], 'string', 'max' => 255],
            [['codBarras'], 'unique'],
            [['Biblioteca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Biblioteca::className(), 'targetAttribute' => ['Biblioteca_id' => 'id']],
            [['EstatutoExemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estatutoexemplar::className(), 'targetAttribute' => ['EstatutoExemplar_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
            [['TipoExemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoexemplar::className(), 'targetAttribute' => ['TipoExemplar_id' => 'id']],
            [['Fundo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fundo::className(), 'targetAttribute' => ['Fundo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'cota' => 'Cota',
            'codBarras' => 'Código de Barras',
            'suplemento' => 'Exemplar suplemento da obra',
            'estado' => 'Estado do exemplar',
            'notaInterna' => 'Nota interna referente ao exemplar',
            'Biblioteca_id' => 'Biblioteca',
            'EstatutoExemplar_id' => 'Estatuto',
            'TipoExemplar_id' => 'Tipo',
            'Obra_id' => 'Obra',
            'Fundo_id' => 'Fundo',
        ];
    }

    /**
     * Gets query for [[Consultatreals]].
     *
     * @return \yii\db\ActiveQuery|ConsultatrealQuery
     */
    public function getConsultatreals()
    {
        return $this->hasMany(Consultatreal::className(), ['Exemplar_id' => 'id']);
    }

    /**
     * Gets query for [[Biblioteca]].
     *
     * @return \yii\db\ActiveQuery|BibliotecaQuery
     */
    public function getBiblioteca()
    {
        return $this->hasOne(Biblioteca::className(), ['id' => 'Biblioteca_id']);
    }

    /**
     * Gets query for [[EstatutoExemplar]].
     *
     * @return \yii\db\ActiveQuery|EstatutoexemplarQuery
     */
    public function getEstatutoExemplar()
    {
        return $this->hasOne(Estatutoexemplar::className(), ['id' => 'EstatutoExemplar_id']);
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
     * Gets query for [[TipoExemplar]].
     *
     * @return \yii\db\ActiveQuery|TipoexemplarQuery
     */
    public function getTipoExemplar()
    {
        return $this->hasOne(Tipoexemplar::className(), ['id' => 'TipoExemplar_id']);
    }

    /**
     * Gets query for [[Fundo]].
     *
     * @return \yii\db\ActiveQuery|FundoQuery
     */
    public function getFundo()
    {
        return $this->hasOne(Fundo::className(), ['id' => 'Fundo_id']);
    }

    /**
     * Gets query for [[Requisicaos]].
     *
     * @return \yii\db\ActiveQuery|RequisicaoQuery
     */
    public function getRequisicaos()
    {
        return $this->hasMany(Requisicao::className(), ['Exemplar_id' => 'id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery|ReservaQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['Exemplar_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ExemplarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExemplarQuery(get_called_class());
    }
}