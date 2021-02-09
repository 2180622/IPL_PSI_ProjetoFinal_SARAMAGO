<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Empréstimo';
$this->params['breadcrumbs'][] = ['label' => 'Circulação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cir">
    <?php
        if($leitor == null)
        {
            echo'<div class="alert alert-info config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Utilize o menu rápido para começar.
            </div>';
        }

        if(is_numeric($leitor) && $leitor == 404)
        {
            echo'<div class="alert alert-warning config" role="alert" id="alert-saramago">
                    <strong>Informação:</strong> Utilizador não encontrado.
                </div>';
        }
        elseif($leitor != null)
        {
            echo '<div class="grid-container">
            <div class="menu-info-saramago">
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
            <p>Data Registado: '.Yii::$app->formatter->asDatetime($leitor->dataRegisto).'</p>
            <p>Data Atualizado: '.Yii::$app->formatter->asDatetime($leitor->dataAtualizado).'</p> 
            </div>';
            echo '<div class="menu-nav-saramago">'
                .Html::button(FAS::icon('eye') . ' Ver Leitor', ['value' => Url::toRoute(['leitor/view','id'=>$leitor->id]), 'class' => 'btn btn-alt', 'id' => 'modalButtonLeitorView'])
                .' '.Html::button(FAS::icon('print') . ' Imprimir', ['value' => 'leitor/create', 'class' => 'btn btn-alt', 'disabled' => 'disabled', 'id' => 'modalButtonCreate'])
                .Html::button(FAS::icon('sign-out-alt') . ' Fechar sessão', ['onclick'=>"location.href='fechar-sessao?redirect=emprestimo';", 'class' => 'btn btn-alt pull-right'])
                .'</div>';
            echo '<div class="menu-table-saramago">';

                if($i = $leitor->getIrregularidades()->where(['>=','irregularidade.dataFinal',date('Y-m-d')])->one())
                {
                    echo'<div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Irregularidade Ativa!</h4>
                            O leitor possui uma irregularidade ativa.
                            <hr>
                            <strong> Data Inicial:</strong> '.Yii::$app->formatter->asDatetime($i->dataInicial, 'long').'<br>
                            <strong> Data Final:</strong> '.Yii::$app->formatter->asDate($i->dataFinal, 'long').'<br>
                            <strong> Motivo:</strong> Entrega tardia de '.$i->tipoIrregularidade->irregularidade.'
                         </div>';
                }else{

                    echo $this->render('_form',['emprestimoModel'=>$emprestimoModel, 'leitorId'=>$leitor->id]);

                    echo '<div class="row">';
                    echo '<div class="col-md-10">';
                    echo Html::listBox('Requesitados','',['Exemplares'=>$requisitados], ['style'=>'width: 100%; height: 200px', 'multiple' => 'false','empty'=>'Sem empréstimos']);
                    echo '</div>';
                    echo '<div class="col-md-offset-2">';
                    echo '</div>';
                    echo '</div>';
                }
            echo '</div>';
            echo '</div>';

            //MODAL
            Modal::begin([
                'header' => '<h4>'.$leitor->nome.' <small class="text-muted"> ('.$leitor->user->username.')</small></h4>',
                'id' => 'modalViewLeitor',
                'size' => 'modal-lg',
                'clientOptions' => ['backdrop' => 'static']
            ]);
            echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
            Modal::end();

        }


    ?>

    <?php
    $this->registerJs(/**@lang JavaScript*/"
                $(function () {
                    if(location.hash == '#go')
                    {
                        $('#rapido-saramago .nav a[href=\"#tab1\"]').tab('show');
                    }
                });
                
                $(function () {
                    $('#modalButtonLeitorView').click(function (){
                    $('#modalViewLeitor').modal('show')
                        .find('#modalContent')
                        .load($(this).attr('value'))
                    })
                });
                
                /*$(function (){
                    if(Array.isArray(requesitados) && requesitados.length )
                    {
                        window.onbeforeunload = function() {
                            return 'Dialog text here.';
                        };
                    }
                });  */
        ");
    ?>

</div>
