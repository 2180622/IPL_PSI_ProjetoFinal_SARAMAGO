<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reprografia".
 *
 * @property int $id Chave primária
 * @property string $dataPedido Data do pedido
 * @property string|null $dataConcluido Data da conclusão
 * @property string $paginas Numero das Páginas
 * @property string $cor Cor da impressão
 * @property int|null $copias Número de Cópias
 * @property int|null $frenteVerso Escolha do frente e verso
 * @property string|null $estado Estado do pedido
 * @property string|null $notaOpac Nota para OPAC
 * @property string|null $notaInterna Nota Interna
 * @property string $operador Operador
 * @property int $Leitor_id Chave estrangeira
 * @property int $Obra_id Chave estrangeira
 *
 * @property Leitor $leitor
 * @property Obra $obra
 */
class Reprografia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reprografia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dataPedido', 'paginas', 'cor', 'operador', 'Leitor_id', 'Obra_id'], 'required'],
            [['dataPedido', 'dataConcluido'], 'safe'],
            [['cor', 'estado'], 'string'],
            [['copias', 'frenteVerso', 'Leitor_id', 'Obra_id'], 'integer'],
            [['paginas', 'notaOpac', 'notaInterna', 'operador'], 'string', 'max' => 255],
            [['Leitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'dataPedido' => 'Data do pedido',
            'dataConcluido' => 'Data da conclusão',
            'paginas' => 'Numero das Páginas',
            'cor' => 'Cor da impressão',
            'copias' => 'Número de Cópias',
            'frenteVerso' => 'Escolha do frente e verso',
            'estado' => 'Estado do pedido',
            'notaOpac' => 'Nota para OPAC',
            'notaInterna' => 'Nota Interna',
            'operador' => 'Operador',
            'Leitor_id' => 'Chave estrangeira',
            'Obra_id' => 'Chave estrangeira',
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
     * @return ReprografiaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReprografiaQuery(get_called_class());
    }
}
