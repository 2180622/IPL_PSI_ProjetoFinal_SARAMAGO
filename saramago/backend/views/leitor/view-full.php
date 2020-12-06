<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Nav;
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
            echo'<p>Estatuto: '.$model->tipoLeitor->estatuto.' ('.$model->tipoLeitor->tipo.')</p>';
            if($model->tipoLeitor->tipo == 'Aluno')
            {
                // FIXME
                //echo'<p>Número: '.$model->alunos->numero.'</p>';
                //echo'<p>Curso: '.$model->alunos->curso_id.'</p>';
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
            <?= Html::button(FAS::icon('plus') . ' Editar', ['value' => 'leitor/update', 'class' => 'btn btn-alt', 'id' => 'modalButtonCreate']) ?>
            <?= Html::button(FAS::icon('key') . ' Repor Password', ['value' => 'leitor/repor', 'class' => 'btn btn-alt', 'id' => 'modalButtonCreate']) ?>
            <?= Html::a(Html::button(FAS::icon('trash-alt').' Eliminar', ['class' => 'btn btn-alt ']), Url::to(['delete', 'id' => $model->id]),
                ['data' =>
                    ['confirm' => 'Tem a certeza de que pretende apagar o leitor ' . $model->nome . '?', 'method' => 'post']
                ]); ?>
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

                ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>
        </div>
    </div>
</div>