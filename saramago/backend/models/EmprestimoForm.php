<?php


namespace backend\models;

use common\models\Estatutoexemplar;
use common\models\Exemplar;
use common\models\Leitor;
use common\models\Requisicao;
use common\models\Reserva;
use yii\base\Model;

class EmprestimoForm extends Model
{
    public $codBarras;
    public $Leitor_id;

    public function rules()
    {
        $rules = parent::rules();

        $child = [['codBarras', 'exist', 'skipOnEmpty' => false, 'targetClass' => '\common\models\Exemplar', 'message' => 'Não existe nenhum exemplar associado']];
        $child_2 =  [['Leitor_id', 'exist', 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']]];

        return array_merge($rules,$child, $child_2);
    }


    /**
     * @return false|int
     */
    public function create()
    {
        if($this->validate())
        {
            $codBarras = $this->codBarras;
            $exemplar = Exemplar::find()->where(['codBarras'=> $codBarras])->one();

            //Calculo de nItens
            if($this->calcQuantItens($this->Leitor_id) == true)
            {
                //Se os exemplares não tiverem os seguintes critérios
                if($exemplar->estado != Exemplar::ESTADO_EMPRESTADO || $exemplar->estado != Exemplar::ESTADO_QUARENTENA ||
                    $exemplar->estado != Exemplar::ESTADO_PERDIDO || $exemplar->estado != Exemplar::ESTADO_TRANSFERENCIA ||
                    $exemplar->estado != Exemplar::ESTADO_ND || $exemplar->estatutoExemplar->id == 4)
                {
                    return 'SARAMAGO400';
                }
                elseif($exemplar->estado == Exemplar::ESTADO_RESERVADO)
                {
                    $reserva = $exemplar->getReservas()->where(['dataFecho'=> null])->orderBy(['dataReserva'=> SORT_ASC])->limit('1')->one();

                    if($reserva->Leitor_id == $this->Leitor_id)
                    {
                        $reserva->estadoReserva = Reserva::ESTADO_RESERVADO;
                        $reserva->dataFecho = date('Y-m-d H:i:s');
                        $reserva->save();

                        $requisicao = new Requisicao();
                        $requisicao->entregaPrevista = $this->calcEntrega($this->Leitor_id, $exemplar->id);
                        $requisicao->Leitor_id = $this->Leitor_id;
                        $requisicao->Exemplar_id = $exemplar->id;
                        $requisicao->save();

                        $exemplar->estado = Exemplar::ESTADO_EMPRESTADO;
                        $exemplar->save();

                        return $requisicao->id;
                    }
                    else {return 'SARAMAGO403';}
                }
                else {
                    $requisicao = new Requisicao();
                    $requisicao->entregaPrevista = $this->calcEntrega($this->Leitor_id, $exemplar->id);
                    $requisicao->Leitor_id = $this->Leitor_id;
                    $requisicao->Exemplar_id = $exemplar->id;
                    $requisicao->save();

                    $exemplar->estado = Exemplar::ESTADO_EMPRESTADO;
                    $exemplar->save();

                    return $requisicao->id;
                }

            }else{

                return 'SARAMAGO401';
            }
        }
    }


    private function calcEntrega($idLeitor, $idExemplar)
    {
        $leitor = Leitor::find()->where(['id'=> $idLeitor])->one();
        $exemplar = Exemplar::find()->where(['id'=> $idExemplar])->one();

        if(($leitor && $exemplar) != null)
        {
            $tipoLeitor = $leitor->getTipoLeitor()->one();
            $prazoDias = $tipoLeitor->prazoDias;

            $estExemplar = $exemplar->getEstatutoExemplar()->one();

            $dateNow = date('Y-m-d');

            if($estExemplar->id == Estatutoexemplar::ID_NORMAL)
            {
                return date('Y-m-d', strtotime($dateNow.'+ '.$prazoDias.' days'));
            }
            elseif ($estExemplar->id == Estatutoexemplar::ID_CURTO)
            {
                return date('Y-m-d', strtotime($dateNow.'+ '.$estExemplar->prazo.' days'));

            }
            elseif ($estExemplar->id == Estatutoexemplar::ID_DIARIO)
            {
                return date('Y-m-d', strtotime($dateNow.'+ '.$estExemplar->prazo.' days'));
            }
            else
                {
                    return 'nreq';
                }
        }
        else{return false;}
    }

    private function calcQuantItens($idLeitor)
    {
        $leitor = Leitor::find()->where(['id'=> $idLeitor])->one();

        $exemplaresEmp = $leitor->getRequisicaos()->where(['dataDevolucao'=>null])->count();
        $nItens = $leitor->getTipoLeitor()->one()->nItens;

        if($exemplaresEmp <= $nItens-1)
        {
            return true;
        }
        else
            {
                return false;
            }
    }
}