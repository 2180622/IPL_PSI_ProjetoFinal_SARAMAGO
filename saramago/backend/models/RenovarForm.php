<?php


namespace backend\models;

use common\models\Config;
use common\models\Estatutoexemplar;
use common\models\Exemplar;
use common\models\Leitor;
use common\models\Requisicao;
use common\models\Reserva;
use yii\base\Model;

class RenovarForm extends Model
{
    public $codBarras;
    public $Leitor_id;

    public function rules()
    {
        $rules = parent::rules();

        $child = [['codBarras', 'exist', 'skipOnEmpty' => false, 'targetClass' => '\common\models\Exemplar', 'message' => 'Não existe nenhum exemplar associado']];
        $child_2 = [['Leitor_id', 'exist', 'targetClass' => Leitor::className(), 'targetAttribute' => ['Leitor_id' => 'id']]];

        return array_merge($rules, $child, $child_2);
    }


    /**
     * @return false|int
     */
    public function renovar($codBarras)
    {
        $exemplar = Exemplar::find()->where(['codBarras' => $codBarras])->one();
        $requisicao = $exemplar->getRequisicaos()->where(['dataDevolucao' => null])->limit('1')->one();
        $leitor = $requisicao->leitor;

        $reservas = $exemplar->getReservas()->where(['dataFecho' => null]);

        if ($reservas->count() != 0) {
            return false;

        } else {
            $requisicao->Renovacoes++;
            $requisicao->entregaPrevista;

            $tipoLeitor = $leitor->getTipoLeitor()->one();
            $prazoDias = $tipoLeitor->prazoDias;

            $estExemplar = $exemplar->getEstatutoExemplar()->one();

            $datePrevisto = \Yii::$app->formatter->asDate($requisicao->entregaPrevista, 'Y-m-d');

            if ($estExemplar->id == Estatutoexemplar::ID_NORMAL) {
                $requisicao->entregaPrevista = date('Y-m-d', strtotime($datePrevisto . '+ ' . $prazoDias . ' days'));
            } elseif ($estExemplar->id == Estatutoexemplar::ID_CURTO) {
                $requisicao->entregaPrevista = date('Y-m-d', strtotime($datePrevisto . '+ ' . $estExemplar->prazo . ' days'));

            } elseif ($estExemplar->id == Estatutoexemplar::ID_DIARIO) {
                $requisicao->entregaPrevista = date('Y-m-d', strtotime($datePrevisto . '+ ' . $estExemplar->prazo . ' days'));
            }

            return true;
        }
    }
}