<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\obra */

$this->title = $model->titulo . ' ('. $model->ano .')';
$this->params['breadcrumbs'][] = ['label' => 'Obras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="site-cat obra-view">

    <?php //TODO FAZER
/*    if($dataProvider->totalCount == 0){
        echo '<div class="alert alert-info alert-dismissible config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Comece por registar os exemplares pertecentes a obra.
              </div>';
    }
    */?>
    <div class="grid-container">
        <div class="menu-info-saramago">
            <?php
            if ($model->imgCapa != null)
            {
                echo Html::img('@web/img/' . $model->imgCapa,['width' => '100%', 'alt'=> $model->titulo . ' ('. $model->ano .')']);
            }

            echo'<h4>'.$model->titulo.' <small class="text-muted"> ('.$model->ano.')</small></h4>';

            echo'<p>Ano: '.$model->ano.'</p><br>';
            echo'<p>Data Registado: '.Yii::$app->formatter->asDatetime($model->dataRegisto).'</p>';
            echo'<p>Data Atualizado: '.Yii::$app->formatter->asDatetime($model->dataAtualizado).'</p>';
            ?>
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('pencil-alt') . ' Editar Obra',
                ['value' => 'update', 'class' => 'btn btn-alt','id' => 'modalButtonUpdate']) ?>
            <?= Html::a(Html::button(FAS::icon('trash-alt').' Apagar obra', ['class' => 'btn btn-alt ']), Url::to(['delete', 'id' => $model->id]),
                ['data' =>
                    ['confirm' => 'Tem a certeza de que pretende apagar a obra ' . $model->titulo .' ('.$model->ano.')' . '?',
                        'method' => 'post']
                ]); ?>

            <?= Html::button(FAS::icon('plus') . ' Adicionar Exemplar',
                ['value' => 'exemplar-create', 'class' => 'btn btn-alt pull-right','id' => 'modalButtonCreate']) ?>
        </div>
        <div class="menu-table-saramago">

            <?php
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Ficha da Obra',
                        'content' => DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',
                                'imgCapa',
                                'titulo',
                                [
                                    'attribute' => 'resumo',
                                    'label' => 'Resumo',
                                    'format' => 'html',
                                ],
                                'editor',
                                'ano',
                                'tipoObra',
                                'descricao',
                                'local',
                                'edicao',
                                'assuntos',
                                'preco',
                                'dataRegisto',
                                'dataAtualizado',
                                'Cdu_id',
                                'Colecao_id',
                            ],
                        ]),

                        //'options' => ['id' => 'myveryownID'],
                    ],
                    [
                        'label' => 'Exemplares '. Html::tag('span', $totalExemplaresDaObra, ['class'=>'badge badge-light']),
                        'encode'=> false,
                        'content'=> $this->renderAjax('exemplar/index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider, 'exemplarModels' => $exemplarModels]),
                    ],

                ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>

        </div>
    </div>
</div>

<?php
    $this->registerJs("
        $(function () {
            $('#modalButtonCreate').click(function (){
                $('#modalCreate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");

?>

<?php
    Modal::begin([
        'header' => '<h3>Adicionar exemplar</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
?>