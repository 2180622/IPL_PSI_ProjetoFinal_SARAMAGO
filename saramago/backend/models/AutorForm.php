<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Autor;
use DateTime;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

/**
 * AutorCreate form
 */
class AutorForm extends Autor
{

    const NACIONALIDADE =[
        'AFG' =>'Afeganistão', 'ALB'=>'Albânia', 'ALG'=>'Argélia',
        'AND' =>'Andorra','ANG'=>'Angola', 'ANT'=>'Antígua e Barbuda',
        'ARG' =>'Argentina', 'ARM'=>'Armênia','ARU'=>'Aruba', 'ASA'=>'Samoa Americana',
        'AUS' =>'Austrália', 'AUT'=>'Áustria', 'AZE'=>'Azerbaijão',
        'BAH' =>'Bahamas', 'BAN'=>'Bangladesh', 'BAR'=>'Barbados',
        'BDI' =>'Burundi', 'BEL'=>'Bélgica', 'BEN'=>'Benim',
        'BER' =>'Bermudas', 'BHU'=>'Butão', 'BIH'=>'Bosnia Bósnia e Herzegovina',
        'BIZ' =>'Belize', 'BLR'=>'Belarus', 'BOL'=>'Bolívia',
        'BOT' =>'Botsuana', 'BRA'=>'Brasil', 'BRN'=>'Bareine',
        'BRU' =>'Brunei Darussalam', 'BUL'=>'Bulgária', 'BUR'=>'Burkina Faso',
        'CAF' =>'Central República Centroafricana', 'CAM'=>'Camboja', 'CAN' => 'Canadá',
        'CAY' => 'Ilhas Cayman', 'CGO' => 'Republic of Congo', 'CHA' => 'Chade',
        'CHI' => 'Chile', 'CHN' => 'República Popular da China', 'CIV' => 'Costa do Marfim',
        'CMR' => 'Camarões', 'COD' => 'República Democrática do Congo', 'COK' => 'Ilhas Cook',
        'COL' => 'Colômbia','COM'=>'Comores', 'CPV'=>'Cabo Verde',
        'CRC' => 'Costa Rica', 'CRO' => 'Croácia', 'CUB' => 'Cuba', 'CYP' => 'Chipre',
        'CZE' => 'República Tcheca', 'DEN' => 'Dinamarca', 'DJI' => 'Djibuti',
        'DMA' => 'República Dominicana', 'DOM' => 'Dominica', 'ECU'=>'Equador',
        'EGY' => 'Egito', 'ERI' => 'Eritreia', 'ESA' => 'El Salvador',
        'ESP' => 'Espanha', 'EST' => 'Estônia', 'ETH' => 'Etiópia',
        'FIJ' => 'Fiji','FIN' => 'Finlândia', 'FRA' => 'França',
        'FSM' => 'Federated States Estados Federados da Micronésia',
        'GAB' => 'Gabão','GAM' => 'Gâmbia','GBR' => 'Grã-Bretanha',
        'GBS' => 'GuineaGuiné-Bissau', 'GEO' => 'Geórgia',
        'GEQ' => 'Guiné Equatorial', 'GER' => 'Alemanha',
        'GHA' => 'Gana', 'GRE' => 'Grécia',
        'GRN' => 'Granada', 'GUA' => 'Guatemala',
        'GUI' => 'Guiné', 'GUM' => 'Guam',
        'GUY' => 'Guiana', 'HAI' => 'Haiti',
        'HKG' => 'Hong KongHong Kong, China',
        'HON' => 'Honduras', 'HUN' => 'Hungria',
        'INA' => 'Indonésia', 'IND' => 'Índia',
        'IOA' => 'Independent Atletas Olímpicos Independentes',
        'IRI' => 'República Islâmica do Irã',
        'IRL' => 'Irlanda', 'IRQ' => 'Iraque',
        'ISL' => 'Islândia', 'ISR' => 'Israel',
        'ISV' => 'Ilhas Virgens Americanas',
        'ITA' => 'Itália',
        'IVB' => 'British Ilhas Virgens Britânicas',
        'JAM' => 'Jamaica',
        'JOR' => 'Jordânia',
        'JPN' => 'Japão',
        'KAZ' => 'Cazaquistão',
        'KEN' => 'Quênia',
        'KGZ' => 'República Popular Democrática do Laos',
        'KIR' => 'Kiribati',
        'KOR' => 'República da Coreia',
        'KOS' => 'Kosovo',
        'KSA' => 'Arábia Saudita',
        'KUW' => 'Quirguistão',
        'LAO' => 'Letônia',
        'LAT' => 'Líbano',
        'LBA' => 'Liechtenstein',
        'LBN' => 'Lesoto',
        'LBR' => 'Líbia',
        'LCA' => 'Santa Lúcia',
        'LES' => 'Libéria',
        'LIE' => 'Lituânia',
        'LTU' => 'Luxemburgo',
        'LUX' => 'Ex-República Iugoslava da Macedônia',
        'MAD' => 'Madagascar',
        'MAR' => 'Marrocos',
        'MAS' => 'Malásia',
        'MAW' => 'Maláui',
        'MDA' => 'República da Moldova',
        'MDV' => 'Maldivas',
        'MEX' => 'México',
        'MGL' => 'Mongólia',
        'MHL' => 'Ilhas Marshall',
        'MKD' => 'North Macedonia Ex-República Iugoslava da Macedônia',
        'MLI' => 'Mali',
        'MLT' => 'Malta',
        'MNE' => 'Montenegro',
        'MON' => 'Mônaco',
        'MOZ' => 'Moçambique',
        'MRI' => 'Maurício',
        'MTN' => 'Mauritânia',
        'MYA' => 'Myanmar',
        'NAM' => 'Namíbia',
        'NCA' => 'Nicarágua',
        'NED' => 'Países Baixos',
        'NEP' => 'Nepal',
        'NGR' => 'Nigéria',
        'NIG' => 'Níger',
        'NOR' => 'Noruega',
        'NRU' => 'Nauru',
        'NZL' => 'Nova Zelândia',
        'OMA' => 'Omã',
        'PAK' => 'Paquistão',
        'PAN' => 'Panamá',
        'PAR' => 'Paraguai',
        'PER' => 'Peru',
        'PHI' => 'Filipinas',
        'PLE' => 'Palestina',
        'PLW' => 'Palau',
        'PNG' => 'Papua Papua Nova Guiné',
        'POL' => 'Polônia',
        'POR' => 'Portugal',
        'PRK' => 'República Popular Democrática da Coreia',
        'PUR' => 'Porto Rico',
        'QAT' => 'Catar',
        'ROT' => 'Refugee Time Olímpico de Refugiados',
        'ROU' => 'Romênia',
        'RSA' => 'África do Sul',
        'RUS' => 'Federação da Rússia',
        'RWA' => 'Ruanda',
        'SAM' => 'Samoa',
        'SEN' => 'Senegal',
        'SEY' => 'Senegal',
        'SGP' => 'Singapura',
        'SKN' => 'Saint Kitts São Cristóvão e Névis',
        'SLE' => 'Sérvia',
        'SLO' => 'Eslovênia',
        'SMR' => 'San Marino',
        'SOL' => 'Ilhas Salomão',
        'SOM' => 'Somália',
        'SRB' => 'Sérvia',
        'SRI' => 'Sri Lanka',
        'SSD' => 'Sudão do Sul',
        'STP' => 'São Tomé São Tomé e Príncipe',
        'SUD' => 'Sudão',
        'SUI' => 'Suíça',
        'SUR' => 'Suriname',
        'SVK' => 'Eslováquia',
        'SWE' => 'Suécia',
        'SWZ' => 'Suazilândia',
        'SYR' => 'República Árabe da Síria',
        'TAN' => 'República Unida da Tanzânia',
        'TGA' => 'Tonga',
        'THA' => 'Tailândia',
        'TJK' => 'Tadjiquistão',
        'TKM' => 'Turcomenistão',
        'TLS' => 'República Democrática de Timor-Leste',
        'TOG' => 'Togo',
        'TPE' => 'Taipé Chinesa',
        'TTO' => 'Trinidad Trinidad e Tobago',
        'TUN' => 'Tunísia',
        'TUR' => 'Turquia',
        'TUV' => 'Tuvalu',
        'UAE' => 'United Emirados Árabes Unidos',
        'UGA' => 'Uganda',
        'UKR' => 'Ucrânia',
        'URU' => 'Uruguai',
        'USA' => 'Estados Unidos da América',
        'UZB' => 'Uzbequistão',
        'VAN' => 'Vanuatu',
        'VEN' => 'Venezuela',
        'VIE' => 'Vietnã',
        'VIN' => 'Saint Vincent and São Vicente e Granadinas',
        'YEM' => 'Iêmen',
        'ZAM' => 'Zâmbia',
        'ZIM' => 'Zimbábue'];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['primeiroNome', 'trim'],
            ['primeiroNome', 'required'],
            ['primeiroNome', 'string', 'min' => 2, 'max' => 255],

            ['segundoNome', 'trim'],
            ['segundoNome', 'string', 'max' => 255],

            ['apelido', 'trim'],
            ['apelido', 'string', 'max' => 255],

            ['tipo', 'trim'],
            ['tipo', 'required'],

            ['bibliografia', 'trim'],
            ['bibliografia', 'string'],

            ['dataNasc', 'trim'],
            ['dataNasc', 'required'],
            ['dataNasc', 'safe'],
            ['dataNasc', 'string', 'min' => 1, 'max' => 50],

            ['nacionalidade', 'trim'],
            ['nacionalidade', 'string', 'max' => 3],

            ['orcid', 'trim'],
            ['orcid', 'unique', 'targetClass' => '\common\models\Autor', 'message' => 'Número de ORCID em uso.'],
            ['orcid', 'string', 'min'=>16,'max' => 16],

        ];
    }

    /**
     * {@inheritdoc}
     */
   public function attributeLabels()
    {
        return [
            'id' => 'Chave primária',
            'primeiroNome' => 'Primeiro Nome',
            'segundoNome' => 'Segundo Nome',
            'apelido' => 'Apelido',
            'tipo' => 'Tipo',
            'bibliografia' => 'Bibliografia',
            'dataNasc' => 'Data de Nascimento',
            'nacionalidade' => 'Nacionalidade',
            'orcid' => 'ORCID',
        ];
    }

    public function __construct($config = [])
    {
        parent::__construct($config);
    }
}
