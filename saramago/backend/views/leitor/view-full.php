<?php

use common\models\Aluno;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Leitores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-leitor leitor-full">
    <div class="grid-container">
        <div class="menu-info-saramago">
            <?php
            echo'<h3>'.$model->nome.' <small class="text-muted"> ('.$model->user->username.')</small></h3>';
            echo'<p class="text-muted" style="line-height: normal">'.$model->morada.'<br>';
            echo $model->codPostal($model->id).' '.$model->localidade.'</p>';
            echo'<p>Estatuto: '.$model->tipoEstatuto($model->id).'</p>';
            if($model->tipoLeitor->tipo == 'aluno')
            {
                $aluno = Aluno::find()->where('Leitor_id = '. $model->id)->one();
                echo'<p>Número: '. $aluno->numero .'</p>';
                //echo'<p>Curso: '.$aluno->curso->nome.'</p>';
            }
            elseif ($model->tipoLeitor->tipo == 'Docente' || $model->tipoLeitor->tipo == 'Funcionário')
            {
                echo'<p>Departamento: '.$model->funcionarios->departamento.'</p>';
            }
            echo'<p>Biblioteca: '.$model->biblioteca->nome.'</p>';
            echo'<p>Data Registado: '.Yii::$app->formatter->asDatetime($model->dataRegisto).'</p>';
            echo'<p>Data Atualizado: '.Yii::$app->formatter->asDatetime($model->dataAtualizado).'</p>';
            ?>

        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('pencil-alt') . ' Editar', ['value' => 'leitor/update', 'class' => 'btn btn-alt', 'id' => 'modalButtonUpdate']) ?>
            <?= Html::a(Html::button(FAS::icon('trash-alt').' Eliminar', ['class' => 'btn btn-alt ']), Url::to(['delete', 'id' => $model->id]),
                ['data' =>
                    ['confirm' => 'Tem a certeza de que pretende apagar o leitor ' . $model->nome . '?', 'method' => 'post']
                ]); ?>

            <?= ButtonDropdown::widget([
                'label' => FAS::icon('user-cog') . ' Opções',
                'encodeLabel' => false,
                'options' => ['class' => 'btn btn-alt dropdown-toggle'],
                'dropdown' => [
                    'encodeLabels' => false,
                    'options' => ['class' => 'dropdown-menu-right'],
                    'items' => [
                        [
                            'label' => FAS::icon('key') . ' Repor Password',
                            'options' => ['class' => 'btn btn-secondary', 'id' => 'modalButtonPswReset'],
                        ],
                        [
                            //FIXME 
                            'label' => FAS::icon('trash-alt') . ' Eliminar Autor',
                            'options' => ['value' => 'leitor/repor',
                                'class' => 'btn btn-secondary',

                            ],
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="menu-table-saramago">
            <?php
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Requisitar',
                        'content' => 'Anime...',
                        'active' => true
                    ],
                    [
                        'label' => 'Ficha do Leitor',
                        'content' => DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'codBarras',
                                'nome',
                                'nif',
                                'docId',
                                'dataNasc',
                                'morada',
                                'localidade',
                                'codPostal',
                                'telemovel',
                                'telefone',
                                [
                                    'label' => 'E-mail',
                                    'attribute' => 'user_id',
                                    'value' => function ($leitores) {
                                        return '' . $leitores->user->email;
                                    },
                                ],
                                'notaInterna',
                                'dataRegisto',
                                [
                                    'label' => 'Biblioteca',
                                    'attribute' => 'Biblioteca_id',
                                    'value' => function ($leitores) {
                                        return '' . $leitores->biblioteca->codBiblioteca . ' - ' . $leitores->biblioteca->nome;
                                    }
                                ],
                                [
                                    'label' => 'Estatuto',
                                    'attribute' => 'TipoLeitor_id',
                                    'value' => function ($leitores) {
                                        return '' . $leitores->tipoLeitor->estatuto;
                                    }
                                ],
                                [
                                    'label' => 'Tipo',
                                    'attribute' => 'TipoLeitor_id',
                                    'value' => function ($leitores) {
                                        return '' . $leitores->tipoLeitor->tipo;
                                    }
                                ],
                                [
                                    'label' => 'User',
                                    'attribute' => 'user_id',
                                    'value' => function ($leitores) {
                                        return '' . $leitores->user->username;
                                    },
                                ],
                            ],
                        ]),
                        //'options' => ['id' => 'myveryownID'],
                    ],
                    [
                        'label' => 'Empréstimos '. Html::tag('span','0',['class'=>'badge badge-light']),
                        'encode'=> false,
                        'content'=>'t',

                    ],
                    [
                        'label' => 'Reservas '. Html::tag('span','0',['class'=>'badge badge-light']),
                        'encode'=> false,
                        'content' => '',
                    ],
                    [
                        'label' => 'Posto de Trabalho '. Html::tag('span','0',['class'=>'badge badge-light']),
                        'encode'=> false,
                        'content' =>
                         '',
                    ],
                ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>
        </div>
    </div>
    <?php
    $this->registerJs(/** @lang JavaScript */"
        $(function () {
            $('#modalButtonPswReset').click(function (){
                $('#modalReset').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            });
        })
    ");
    ?>
    <?php
        Modal::begin([
            'header' => '<h4>'.$model->nome.'</h4>',
            'id' => 'modalReset',
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo    '<div id="modalContent">
                    Tem a certeza que pretende repôr a sua password?
                    <div style="text-align:left">'.
                        Html::a(Html::button('Sim', ['class' => 'btn btn-alt']), Url::to(['repor-password', 'id' => $model->id])).
                    '</div>
                    <div style="text-align:left">
                        
                    </div>
                </div>';

        Modal::end();
    ?>
</div>