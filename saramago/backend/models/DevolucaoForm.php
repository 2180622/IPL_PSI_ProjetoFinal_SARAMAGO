<?php


namespace backend\models;

use common\models\Exemplar;
use common\models\Irregularidade;
use common\models\Leitor;
use common\models\Tipoirregularidade;
use yii\base\Model;

class DevolucaoForm extends Model
{
    public $codBarras;

    public function rules()
    {
        $rules = parent::rules();

        $child = [['codBarras', 'exist', 'skipOnEmpty' => false, 'targetClass' => '\common\models\Exemplar', 'message' => 'Não existe nenhum exemplar associado']];

        return array_merge($rules,$child);
    }


    /**
     * @return false|int
     */
    public function run($idExemplar)
    {
        $exemplar = Exemplar::findOne($idExemplar);

        //Verifica o operador/conta na sessão
        $user = Leitor::find()->where(['User_id'=>\Yii::$app->user->id])->one();

        //Verifica se tem alguma reserva [Reserva mais antiga em aberto]
        $reservas = $exemplar->getReservas()->where(['dataFecho' => null])->orderBy(['dataReserva' => SORT_ASC])->limit('1')->one();

        //Se tiver emprestado
        if ($exemplar->estado == Exemplar::ESTADO_EMPRESTADO)
        {
            //Conclui o empréstimo, recorrendo a tabela "Requisição"
            $req = $exemplar->getRequisicaos()->where(['dataDevolucao' => null])->limit('1')->one();
            $req->dataDevolucao = date('Y-m-d H:i:s');
            $req->save();

            //Se a data de devolução é superior data de entrega prevista
            if($req->dataDevolucao > $req->entregaPrevista)
            {
                //verifica o tipo de obra e o tipo de irregularidade aplicável
                $tipoObra = $exemplar->obra->tipoObra;

                if($tipoObra == 'materialAv') {$tipoIrregularidade = Tipoirregularidade::findOne('1');}
                elseif($tipoObra == 'monografia') {$tipoIrregularidade = Tipoirregularidade::findOne('2');}
                elseif($tipoObra == 'pubPeriodica') {$tipoIrregularidade = Tipoirregularidade::findOne('3');}

                $diasTrigger = date('Y-m-d', strtotime(date('Y-m-d').'+ '.$tipoIrregularidade->diasAtivacao.' days'));

                //Se a data de entrega prevista foi superior ao dia de ativação (trigger)
                if($req->entregaPrevista > $diasTrigger)
                {
                    //ativa uma nova irregularidade
                    $irregularidade = new Irregularidade();
                    $irregularidade->dataInicial = date('Y-m-d H:i:s');
                    $irregularidade->dataFinal = date('Y-m-d', strtotime(date('Y-m-d').'+ '.$tipoIrregularidade->diasBloqueio.' days'));
                    $irregularidade->Leitor_id = $user->id;
                    $irregularidade->TipoIrregularidade_id = $tipoIrregularidade->id;
                    $irregularidade->save();
                }
            }
            //Se tiver alguma reserva
            if ($reservas != null)
            {
                //Se conta ADMIN que devolveu
                if($user == null)
                {
                    $exemplar = Exemplar::findOne($idExemplar);
                    $exemplar->estado = Exemplar::ESTADO_RESERVADO;

                    $value = 'SARAMAGO_EMP_RES';

                }
                else{
                    //Se o operador que devolveu pertencer a mesma biblioteca que o leitor que reservou
                    if($reservas->leitor->Biblioteca_id == $user->Biblioteca_id)
                    {
                        $exemplar->estado = Exemplar::ESTADO_RESERVADO;
                        $value = 'SARAMAGO_EMP_RES';
                    }
                    //Se o operador que devolveu não pertencer a mesma biblioteca que o leitor que reservou
                    elseif($reservas->leitor->Biblioteca_id != $user->Biblioteca_id)
                    {
                        $exemplar->estado = Exemplar::ESTADO_TRANSFERENCIA;
                        $value = 'SARAMAGO_EMP_TRA';
                    }
                }
            }
            //Se não tiver reservas
            else{

                //Se conta ADMIN que devolveu
                if($user == null)
                {
                    $exemplar->estado = Exemplar::ESTADO_ARRUMACAO;
                    $value = 'SARAMAGO_EMP_ARR';
                }
                else{
                    //Se o operador que devolveu pertencer a mesma biblioteca que o exemplar
                    if($exemplar->Biblioteca_id == $user->Biblioteca_id)
                    {
                        $exemplar->estado = Exemplar::ESTADO_ARRUMACAO;
                        $value = 'SARAMAGO_EMP_ARR';
                    }
                    //Se o operador que devolveu pertencer a diferente biblioteca
                    elseif($exemplar->Biblioteca_id != $user->Biblioteca_id)
                        {
                            $exemplar->estado = Exemplar::ESTADO_TRANSFERENCIA;
                            $value = 'SARAMAGO_EMP_TRA';
                        }
                }
            }

            //Guarda o novo estado do exemplar
            $exemplar->save();

        }
        //Se tiver em transferência
        elseif ($exemplar->estado == Exemplar::ESTADO_TRANSFERENCIA)
        {
            //Se tiver alguma reserva
            if ($reservas != null)
            {
                //Se conta ADMIN que devolveu
                if ($user == null) {
                    $exemplar->estado = Exemplar::ESTADO_RESERVADO;
                    $value = 'SARAMAGO_TRA_RES';
                } else {
                    //Se o operador que devolveu pertencer a mesma biblioteca que o leitor que reservou
                    if ($reservas->leitor->Biblioteca_id == $user->Biblioteca_id) {
                        $exemplar->estado = Exemplar::ESTADO_RESERVADO;
                        $value = 'SARAMAGO_TRA_RES';
                    } //Se o operador que devolveu não pertencer a mesma biblioteca que o leitor que reservou
                    elseif ($reservas->leitor->Biblioteca_id != $user->Biblioteca_id) {
                        $exemplar->estado = Exemplar::ESTADO_TRANSFERENCIA;
                        $value = 'SARAMAGO_TRA_TRA';
                    }
                }
            }
            //Se não tiver reservas
            else{

                //Se conta ADMIN que devolveu
                if($user == null)
                {
                    $exemplar->estado = Exemplar::ESTADO_ARRUMACAO;
                    $value = 'SARAMAGO_TRA_ARR';
                }
                else{
                    //Se o operador que devolveu pertencer a mesma biblioteca que o exemplar
                    if($exemplar->Biblioteca_id == $user->Biblioteca_id)
                    {
                        $exemplar->estado = Exemplar::ESTADO_ARRUMACAO;
                        $value = 'SARAMAGO_TRA_ARR';
                    }
                    //Se o operador que devolveu pertencer a diferente biblioteca
                    elseif($exemplar->Biblioteca_id != $user->Biblioteca_id)
                    {
                        $exemplar->estado = Exemplar::ESTADO_TRANSFERENCIA;
                        $value = 'SARAMAGO_TRA_TRA';
                    }
                }
            }

            //Guarda o novo estado do exemplar
            $exemplar->save();

        }
        else
            {
                $value = 'SARAMAGO400';
            }
        return $value;
    }
}