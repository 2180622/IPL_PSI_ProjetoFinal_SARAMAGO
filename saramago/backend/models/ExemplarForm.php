<?php
namespace backend\models;

use common\models\Exemplar;
use common\models\Biblioteca;
use common\models\Estatutoexemplar;
use common\models\Tipoexemplar;
use common\models\Obra;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class ExemplarForm extends Exemplar
{
    public $id;
    public $cota;
    public $codBarras;
    public $suplemento;
    public $estado;
    public $notaInterna;
    public $Biblioteca_id;
    public $EstatutoExemplar_id;
    public $TipoExemplar_id;
    public $Obra_id;


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
            [['TipoExemplar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoexemplar::className(), 'targetAttribute' => ['TipoExemplar_id' => 'id']],
            [['Obra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Obra::className(), 'targetAttribute' => ['Obra_id' => 'id']],
            
        ];
    }


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
	            'Obra_id' => 'Obra ID',
	        ];
   	}


    public function createExemplar(){
        if($this->validate()) {
            $exemplar = new Exemplar();

            $exemplar->cota = $this->cota;
            $exemplar->codBarras = str_pad($this->codBarras, 13, 0, STR_PAD_LEFT);
            $exemplar->suplemento = $this->suplemento;
            $exemplar->estado = $this->estado;
            $exemplar->notaInterna = $this->notaInterna;
            $exemplar->Biblioteca_id = $this->Biblioteca_id;
            $exemplar->EstatutoExemplar_id = $this->EstatutoExemplar_id;
            $exemplar->TipoExemplar_id = $this->TipoExemplar_id;
            $exemplar->Obra_id = $this->Obra_id;
            

            $exemplar->save();
        }
    }
}