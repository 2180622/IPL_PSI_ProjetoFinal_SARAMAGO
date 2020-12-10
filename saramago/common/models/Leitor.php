<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "leitor".
 *
 * @property int $id Chave primária
 * @property string $codBarras Código de barras do leitor
 * @property string $nome Nome do Leitor
 * @property int $nif NIF/NIPC
 * @property string|null $docId Nº do Documento de Identificação
 * @property string $dataNasc Data de Nascimento
 * @property string $morada Morada
 * @property string $localidade Localidade
 * @property int $codPostal Código Postal
 * @property int $telemovel Telemóvel
 * @property int|null $telefone Telefone
 * @property string|null $mail2 E-mail (2)
 * @property string|null $notaInterna Nota interna referente ao leitor
 * @property string $dataRegisto Data registado
 * @property string|null $dataAtualizado Data atualizado
 * @property int $Biblioteca_id Chave estrangeira
 * @property int $TipoLeitor_id Chave estrangeira
 * @property int $user_id
 *
 * @property Aluno[] $alunos
 * @property Consultatreal[] $consultatreals
 * @property Funcionario[] $funcionarios
 * @property Irregularidade[] $irregularidades
 * @property User $user
 * @property Biblioteca $biblioteca
 * @property Tipoleitor $tipoLeitor
 * @property Reprografia[] $reprografias
 * @property Requisicao[] $requisicaos
 * @property Reserva[] $reservas
 * @property Reservasposto[] $reservaspostos
 * @property Sugestaoaquisicao[] $sugestaoaquisicaos
 */
class Leitor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'leitor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codBarras', 'nome', 'nif', 'dataNasc', 'morada', 'localidade', 'codPostal', 'telemovel', 'Biblioteca_id', 'TipoLeitor_id', 'user_id'], 'required'],
            [['nif', 'codPostal', 'telemovel', 'telefone', 'Biblioteca_id', 'TipoLeitor_id', 'user_id'], 'integer'],
            [['dataNasc', 'dataRegisto', 'dataAtualizado'], 'safe'],
            [['codBarras', 'nome', 'morada', 'localidade', 'notaInterna'], 'string', 'max' => 255],
            [['docId', 'mail2'], 'string', 'max' => 45],
            [['codBarras'], 'unique'],
            [['nif'], 'unique'],
            [['docId'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['Biblioteca_id'], 'exist', 'skipOnError' => true, 'targetClass' => Biblioteca::className(), 'targetAttribute' => ['Biblioteca_id' => 'id']],
            [['TipoLeitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoleitor::className(), 'targetAttribute' => ['TipoLeitor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'codBarras' => 'Código de barras do leitor',
            'nome' => 'Nome do Leitor',
            'nif' => 'NIF/NIPC',
            'docId' => 'Nº do Documento de Identificação',
            'dataNasc' => 'Data de Nascimento',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'codPostal' => 'Código Postal',
            'telemovel' => 'Telemóvel',
            'telefone' => 'Telefone',
            'mail2' => 'E-mail (2)',
            'notaInterna' => 'Nota interna referente ao leitor',
            'dataRegisto' => 'Data registado',
            'dataAtualizado' => 'Data atualizado',
            'Biblioteca_id' => 'Chave estrangeira',
            'TipoLeitor_id' => 'Chave estrangeira',
            'user_id' => 'User ID',
        ];
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * Gets query for [[Alunos]].
     *
     * @return \yii\db\ActiveQuery|AlunoQuery
     */
    public function getAlunos()
    {
        return $this->hasMany(Aluno::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Consultatreals]].
     *
     * @return \yii\db\ActiveQuery|ConsultatrealQuery
     */
    public function getConsultatreals()
    {
        return $this->hasMany(Consultatreal::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Funcionarios]].
     *
     * @return \yii\db\ActiveQuery|FuncionarioQuery
     */
    public function getFuncionarios()
    {
        return $this->hasMany(Funcionario::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Irregularidades]].
     *
     * @return \yii\db\ActiveQuery|IrregularidadeQuery
     */
    public function getIrregularidades()
    {
        return $this->hasMany(Irregularidade::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
     * Gets query for [[TipoLeitor]].
     *
     * @return \yii\db\ActiveQuery|TipoleitorQuery
     */
    public function getTipoLeitor()
    {
        return $this->hasOne(Tipoleitor::className(), ['id' => 'TipoLeitor_id']);
    }

    /**
     * Gets query for [[Reprografias]].
     *
     * @return \yii\db\ActiveQuery|ReprografiaQuery
     */
    public function getReprografias()
    {
        return $this->hasMany(Reprografia::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Requisicaos]].
     *
     * @return \yii\db\ActiveQuery|RequisicaoQuery
     */
    public function getRequisicaos()
    {
        return $this->hasMany(Requisicao::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Reservas]].
     *
     * @return \yii\db\ActiveQuery|ReservaQuery
     */
    public function getReservas()
    {
        return $this->hasMany(Reserva::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Reservaspostos]].
     *
     * @return \yii\db\ActiveQuery|ReservaspostoQuery
     */
    public function getReservaspostos()
    {
        return $this->hasMany(Reservasposto::className(), ['Leitor_id' => 'id']);
    }

    /**
     * Gets query for [[Sugestaoaquisicaos]].
     *
     * @return \yii\db\ActiveQuery|SugestaoaquisicaoQuery
     */
    public function getSugestaoaquisicaos()
    {
        return $this->hasMany(Sugestaoaquisicao::className(), ['Leitor_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return LeitorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LeitorQuery(get_called_class());
    }

    #region Leitor
    public static function codPostal($id)
    {
        $leitor = Leitor::find($id)->one();

        if(strlen($leitor->codPostal) == 7 ){
            return $cp1 = substr($leitor->codPostal, 0, 4).'-'.$cp2 = substr($leitor->codPostal, 4, 6);
        }else{
            return $leitor->codPostal;
        }
    }

    public static function tipoEstatuto($id)
    {
        $leitor = Leitor::findOne($id);

        if ($leitor->tipoLeitor->tipo == 'aluno') {
            return $leitor->tipoLeitor->estatuto . ' (' . $leitor->tipoLeitor->tipo . ')';
        } elseif ($leitor->tipoLeitor->tipo == 'docente') {
            return $leitor->tipoLeitor->estatuto . ' (' . $leitor->tipoLeitor->tipo . ')';
        } elseif ($leitor->tipoLeitor->tipo == 'funcionario') {
            return $leitor->tipoLeitor->estatuto . ' (' . $leitor->tipoLeitor->tipo . ')';
        } elseif ($leitor->tipoLeitor->tipo == 'externo') {
            return $leitor->tipoLeitor->estatuto . ' (' . $leitor->tipoLeitor->tipo . ')';
        }

        return 0;

    }

    #endregion
}