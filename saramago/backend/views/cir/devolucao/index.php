<?php

/* @var $this yii\web\View */
/* @var $exemplar \common\models\Exemplar */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Devolução';
$this->params['breadcrumbs'][] = ['label' => 'Circulação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cir">

    <?php
        if($exemplar == null)
        {
            echo'<div class="alert alert-info config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Utilize o menu rápido para começar.
            </div>';
        }
        if(is_numeric($exemplar) && $exemplar == 404)
        {
            echo'<div class="alert alert-warning config" role="alert" id="alert-saramago">
                    <strong>Informação:</strong> Exemplar não encontrado.
                </div>';
        }
        elseif(is_numeric($exemplar) && $exemplar == 400)
        {
            echo'<div class="alert alert-danger config" role="alert" id="alert-saramago">
                    <strong>Informação:</strong> O exemplar submetido não está nas condições de ser devolvido. Verifique o seu estado.
                </div>';
        }
        elseif($exemplar != null)
        {
            echo '<div class="grid-container">';
            #region Info Exemplar-Obra
            echo '<div class="menu-info-saramago">';

            if ($exemplar->obra->imgCapa != null)
            {
                echo Html::img('@web/img/' . $exemplar->obra->imgCapa,['width' => '100%', 'alt'=> $exemplar->obra->titulo . ' ('. $exemplar->obra->ano .')']);
            }

            echo'<h4>'.$exemplar->obra->titulo.' <small class="text-muted"> ('.$exemplar->obra->ano.')</small></h4><hr>';

            if($exemplar->obra->tipoObra == "materialAv")
            {
                echo '<p>Tipo de Obra: Material Audio-Visual</p>';
                echo '<p> Duração: '.$exemplar->obra->materialavs->duracao.' min.</p>';
                echo '<p> EAN: '.$exemplar->obra->materialavs->ean.'</p>';
            }
            if($exemplar->obra->tipoObra == "monografia")
            {
                echo '<p>Tipo de Obra: Monografia</p>';
                echo '<p> Volume: '.$exemplar->obra->monografias->volume.'</p>';
                echo '<p> Páginas: '.$exemplar->obra->monografias->paginas.'</p>';
                echo '<p> ISBN: '.$exemplar->obra->monografias->ISBN.'</p>';
            }
            elseif($exemplar->obra->tipoObra == "pubPeriodica")
            {
                echo '<p>Tipo de Obra: Publicação Periódica</p>';
                echo '<p> Volume: '.$exemplar->obra->pubperiodicas->volume.'</p>';
                echo '<p> Série: '.$exemplar->obra->pubperiodicas->serie.'</p>';
                echo '<p> Número: '.$exemplar->obra->pubperiodicas->duracao.'</p>';
                echo '<p> ISNN: '.$exemplar->obra->pubperiodicas->ISNN.'</p>';
            }

            echo '<p>Ano: '.$exemplar->obra->ano.'</p><br>';
            echo '<p>Data Registado: '.Yii::$app->formatter->asDatetime($exemplar->obra->dataRegisto).'</p>';
            echo '<p>Data Atualizado: '.Yii::$app->formatter->asDatetime($exemplar->obra->dataAtualizado).'</p>';
            echo '</div>';
            #endregion
            #region Nav
            echo '<div class="menu-nav-saramago">'
                .Html::button(FAS::icon('eye') . ' Ver Exemplar',
                    ['value_exemplar' => Url::toRoute(['cat/exemplar-view','id'=>$exemplar->id]),'value_obra' => Url::toRoute(['cat/obra-view','id'=>$exemplar->obra->id]),
                        'class' => 'btn btn-alt', 'id' => 'modalButtonExemplarView'])
                .' '.Html::button(FAS::icon('print') . ' Imprimir', ['value' => 'leitor/create', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonCreate'])
                .Html::button(FAS::icon('sign-out-alt') . ' Fechar sessão', ['onclick'=>"location.href='devolucao#go';", 'class' => 'btn btn-alt pull-right'])
                .'</div>';
            #endregion
            #region Table
            echo '<div class="menu-table-saramago">';

            $req = $exemplar->getRequisicaos()->where(['!=','dataDevolucao',null])->orderBy(['dataDevolucao' => SORT_DESC])->limit('1')->one();
            $res = $exemplar->getReservas()->where(['dataFecho' => null])->orderBy(['dataReserva' => SORT_ASC])->limit('1')->one();
            $leitor = $req->leitor;
            $leitor_2 = $res->leitor;

            if($exemplar == 'SARAMAGO_EMP_RES')
            {
                echo '<div class="alert alert-info config" role="alert"><strong>Informação:</strong> O exemplar submetido foi devolvido e possui uma reserva.</div>';
                echo '<div class="row container-fluid">
                        <div class="col-md-5">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Devolvido de...</h4></div>
                                <div class="card-body">
                                    <h3>'.$leitor->nome.' <small class="text-muted"> ('.$leitor->user->username.')</small></h3>
                                    <p class="text-muted" style="line-height: normal">'.$leitor->morada.'<br>'.$leitor->codPostal($leitor->id).' '.$leitor->localidade.'</p>
                                    <p>Estatuto: '.$leitor->tipoEstatuto($leitor->id).'</p>';
                                        if($leitor->tipoLeitor->tipo == 'aluno')
                                        {
                                            echo '<p>Número: '. $leitor->alunos->numero .'</p>';
                                            if($leitor->alunos->curso != null)
                                            {
                                                echo '<p>Curso: '.$leitor->alunos->curso->nome.' ('.$leitor->alunos->curso->CodCurso.')'.'</p>';
                                            }
                                        }
                                        elseif ($leitor->tipoLeitor->tipo == 'docente' || $leitor->tipoLeitor->tipo == 'funcionário')
                                        {
                                            '<p>Departamento: '.$leitor->funcionarios->departamento.'</p>';
                                        }
                                        echo '<p>Biblioteca: '.$leitor->biblioteca->nome.' ('.$leitor->biblioteca->codBiblioteca.')'.'</p>
                                </div>
                                </div>
                        </div>
                        <div class="col-md-2" style="text-align:center; vertical-align: middle;">'.FAS::icon('angle-double-right')->size(FAS::SIZE_4X).'</div>
                        <div class="col-md-5">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Reservado para...</h4></div>
                                    <div class="card-body">
                                        <h3>'.$leitor_2->nome.' <small class="text-muted"> ('.$leitor_2->user->username.')</small></h3>
                                        <p class="text-muted" style="line-height: normal">'.$leitor_2->morada.'<br>'.$leitor_2->codPostal($leitor_2->id).' '.$leitor_2->localidade.'</p>
                                        <p>Estatuto: '.$leitor_2->tipoEstatuto($leitor_2->id).'</p>';
                                        if($leitor_2->tipoLeitor->tipo == 'aluno')
                                        {
                                            echo '<p>Número: '. $leitor_2->alunos->numero .'</p>';
                                            if($leitor_2->alunos->curso != null)
                                            {
                                                echo '<p>Curso: '.$leitor_2->alunos->curso->nome.' ('.$leitor_2->alunos->curso->CodCurso.')'.'</p>';
                                            }
                                        }
                                        elseif ($leitor_2->tipoLeitor->tipo == 'docente' || $leitor_2->tipoLeitor->tipo == 'funcionário')
                                        {
                                            '<p>Departamento: '.$leitor_2->funcionarios->departamento.'</p>';
                                        }
                                        echo '<p>Biblioteca: '.$leitor_2->biblioteca->nome.' ('.$leitor_2->biblioteca->codBiblioteca.')'.'</p>
                                    </div>
                                </div>
                        </div>
                        </div>';
            }
            elseif ($exemplar == 'SARAMAGO_EMP_TRA')
            {
                echo '<div class="alert alert-info config" role="alert"><strong>Informação:</strong> O exemplar submetido foi devolvido e precisa de ser transferido para outra biblioteca.</div>';
                echo '<div class="row container-fluid">
                        <div class="col-md-5">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Devolvido de...</h4></div>
                                    <div class="card-body">
                                        <h3>'.$leitor->nome.' <small class="text-muted"> ('.$leitor->user->username.')</small></h3>
                                        <p class="text-muted" style="line-height: normal">'.$leitor->morada.'<br>'.$leitor->codPostal($leitor->id).' '.$leitor->localidade.'</p>
                                        <p>Estatuto: '.$leitor->tipoEstatuto($leitor->id).'</p>';
                                        if($leitor->tipoLeitor->tipo == 'aluno')
                                        {
                                            echo '<p>Número: '. $leitor->alunos->numero .'</p>';
                                            if($leitor->alunos->curso != null)
                                            {
                                                echo '<p>Curso: '.$leitor->alunos->curso->nome.' ('.$leitor->alunos->curso->CodCurso.')'.'</p>';
                                            }
                                        }
                                        elseif ($leitor->tipoLeitor->tipo == 'docente' || $leitor->tipoLeitor->tipo == 'funcionário')
                                        {
                                            '<p>Departamento: '.$leitor->funcionarios->departamento.'</p>';
                                        }
                                        echo '<p>Biblioteca: '.$leitor->biblioteca->nome.' ('.$leitor->biblioteca->codBiblioteca.')'.'</p>
                                    </div>
                                    <br>
                                    <div class="card-footer">'.Html::button(FAS::icon('print') . ' Imprimir',
                            ['value' => '', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonDevolvido']).'</div>
                                </div>
                        </div>
                        <div class="col-md-2" style="text-align:center; vertical-align: middle;">'.FAS::icon('angle-double-right')->size(FAS::SIZE_4X).'</div>
                        <div class="col-md-5">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Transferir para...</h4></div>
                                    <div class="card-body">
                                        '.$res->leitor->biblioteca->nome.' ('.$res->leitor->biblioteca->codBiblioteca.')'.'
                                        <div class="card-footer">'.Html::button(FAS::icon('eye') . ' Ver Biblioteca',
                                                ['value' => '', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonBiblioteca']).'</div>
                                        </div>
                                    <br>
                                </div>
                            </div>
                      </div>';
            }
            elseif ($exemplar == 'SARAMAGO_EMP_ARR')
            {
                echo '<div class="alert alert-info config" role="alert"><strong>Informação:</strong> O exemplar submetido foi devolvido e encontra-se em arrumação.</div>';
                echo '<div class="row container-fluid">
                        <div class="col-md">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Devolvido de...</h4></div>
                                    <div class="card-body">
                                        <h3>'.$leitor->nome.' <small class="text-muted"> ('.$leitor->user->username.')</small></h3>
                                        <p class="text-muted" style="line-height: normal">'.$leitor->morada.'<br>'.$leitor->codPostal($leitor->id).' '.$leitor->localidade.'</p>
                                        <p>Estatuto: '.$leitor->tipoEstatuto($leitor->id).'</p>';
                                        if($leitor->tipoLeitor->tipo == 'aluno')
                                        {
                                            echo '<p>Número: '. $leitor->alunos->numero .'</p>';
                                            if($leitor->alunos->curso != null)
                                            {
                                                echo '<p>Curso: '.$leitor->alunos->curso->nome.' ('.$leitor->alunos->curso->CodCurso.')'.'</p>';
                                            }
                                        }
                                        elseif ($leitor->tipoLeitor->tipo == 'docente' || $leitor->tipoLeitor->tipo == 'funcionário')
                                        {
                                            '<p>Departamento: '.$leitor->funcionarios->departamento.'</p>';
                                        }
                                        echo '<p>Biblioteca: '.$leitor->biblioteca->nome.' ('.$leitor->biblioteca->codBiblioteca.')'.'</p>
                                    </div>
                                    <br>
                                    <div class="card-footer">'.Html::button(FAS::icon('print') . ' Imprimir',
                                        ['value' => '', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonDevolvido']).'</div>
                            </div>
                        </div>
                      </div>';
            }
            elseif ($exemplar == 'SARAMAGO_TRA_RES')
            {
                echo '<div class="alert alert-info config" role="alert"><strong>Informação:</strong> O exemplar submetido foi devolvido e possui uma reserva.</div>';
                echo '<div class="row container-fluid">
                        <div class="col-md">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Reservado para...</h4></div>
                                    <div class="card-body">
                                        <h3>'.$leitor_2->nome.' <small class="text-muted"> ('.$leitor_2->user->username.')</small></h3>
                                        <p class="text-muted" style="line-height: normal">'.$leitor_2->morada.'<br>'.$leitor_2->codPostal($leitor_2->id).' '.$leitor_2->localidade.'</p>
                                        <p>Estatuto: '.$leitor_2->tipoEstatuto($leitor_2->id).'</p>';
                                        if($leitor_2->tipoLeitor->tipo == 'aluno')
                                        {
                                            echo '<p>Número: '. $leitor_2->alunos->numero .'</p>';
                                            if($leitor_2->alunos->curso != null)
                                            {
                                                echo '<p>Curso: '.$leitor_2->alunos->curso->nome.' ('.$leitor_2->alunos->curso->CodCurso.')'.'</p>';
                                            }
                                        }
                                        elseif ($leitor_2->tipoLeitor->tipo == 'docente' || $leitor_2->tipoLeitor->tipo == 'funcionário')
                                        {
                                            '<p>Departamento: '.$leitor_2->funcionarios->departamento.'</p>';
                                        }
                                        echo '<p>Biblioteca: '.$leitor_2->biblioteca->nome.' ('.$leitor_2->biblioteca->codBiblioteca.')'.'</p>
                                    </div>
                                    <br>
                                    <div class="card-footer">'.Html::button(FAS::icon('print') . ' Imprimir',
                                        ['value' => '', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonDevolvido']).'</div>
                            </div>
                        </div>
                      </div>';
            }
            elseif ($exemplar == 'SARAMAGO_TRA_ARR')
            {
                echo '<div class="alert alert-info config" role="alert"><strong>Informação:</strong> O exemplar submetido foi devolvido e encontra-se em arrumação.</div>';
            }
            elseif ($exemplar == 'SARAMAGO_TRA_TRA')
            {
                echo '<div class="alert alert-info config" role="alert""><strong>Informação:</strong> O exemplar submetido precisa de ser transferido para outra biblioteca.</div>';
                echo '<div class="row container-fluid">
                        <div class="col-md">
                            <div class="card card-cir">
                                <div class="card-title"><h4>Transferir para...</h4></div>
                                    <div class="card-body">
                                    '.$exemplar->biblioteca->nome.' ('.$exemplar->biblioteca->codBiblioteca.')'.'
                                        <div class="card-footer">'.Html::button(FAS::icon('eye') . ' Ver Biblioteca',
                                            ['value' => '', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonBiblioteca']).'</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>';
            }

            echo '</div>';
            #endregion
            echo '</div>';

            //MODAL
            Modal::begin([
                'header' => '<h4>'.$exemplar->cota.' <small class="text-muted"> ('.$exemplar->codBarras.')</small></h4>',
                'id' => 'modalViewExemplar',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static']
            ]);
            echo Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Exemplar',
                            'content' => '<div id="modalContentExemplar">
                                <div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div>
                                </div>',
                            'active' => true
                        ],
                        ['label' => 'Ficha da Obra',
                            'content' => '<div id="modalContentObra">
                                <div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div>
                                </div>',
                        ],
                    ],
                ]);
            Modal::end();
        }

        ?>



<?php
    $this->registerJs(/**@lang JavaScript*/"
            $(function () {
                if(location.hash == '#go'){
                    $('#rapido-saramago .nav a[href=\"#tab2\"]').tab('show');
                }
            });

            $(function () {
                $('#modalButtonExemplarView').click(function (){
                    $('#modalViewExemplar').modal('show');
                    $('#modalViewExemplar').find('#modalContentExemplar').load($(this).attr('value_exemplar'));
                    $('#modalViewExemplar').find('#modalContentObra').load($(this).attr('value_obra'));
                    })
                });
    ");
?>

</div>


