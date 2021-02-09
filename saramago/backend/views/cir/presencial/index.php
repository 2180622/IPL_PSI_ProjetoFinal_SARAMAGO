<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Consultatreal */

use common\models\Exemplar;
use common\models\Leitor;use kartik\datetime\DateTimePicker;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Presencial';
$this->params['breadcrumbs'][] = ['label' => 'Circulação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cir">

    <div class="grid-container">
        <div class="menu-info-saramago">
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('plus') . ' Adicionar', ['value' => Url::toRoute(['leitor/view','id'=>1]), 'class' => 'btn btn-alt pull-right', 'id' => 'modalButtonCreate'])?>
        </div>
        <div class="menu-table-saramago">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'dataHoraInicial',
                'label'=>'Data/Hora Inicial',
                'headerOptions' => ['width' => '300'],
                'format'=>['datetime', 'php:d/m/Y, H:i:s'],
                /*'filter'=> DateTimePicker::widget([
                    'model'=> $searchModel,
                    'attribute' => 'dataHoraInicial',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    //'convertFormat'=>true,
                    'pluginOptions' => [
                        'format' => 'yyyy/dd/mm, hh:ii:ss',
                        'autoclose' => true,
                        'todayBtn' => true
                    ]
                ]),*/
            ],
            [
                'attribute' => 'dataHoraFinal',
                'label'=>'Data/Hora Final',
                'headerOptions' => ['width' => '300'],
                'format'=>['datetime', 'php:d/m/Y, H:i:s'],
                /*'filter'=> DateTimePicker::widget([
                    'model'=> $searchModel,
                    'attribute' => 'dataHoraInicial',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    //'convertFormat'=>true,
                    'pluginOptions' => [
                        'format' => 'yyyy/dd/mm, hh:ii:ss',
                        'autoclose' => true,
                        'todayBtn' => true
                    ]
                ]),*/
            ],
            [
                'attribute'=>'operador',
                'label'=> 'Operador',
                'headerOptions' => ['width' => '150'],
                'value' => function ($model) { if($model->operador != null) {return null;} }
            ],
            [
                'attribute'=> 'Leitor_id',
                'label'=> 'Leitor',
                'headerOptions' => ['width' => '150'],
                'filter'=> ArrayHelper::map(Leitor::find()->asArray()->all(),'id','nome'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'format' => 'html',
                'value' => function ($model) { return Html::a($model->leitor->nome, ['leitor/view-full', 'id' => $model->id]);}
            ],
            [
                'attribute'=> 'Exemplar_id',
                'label'=> 'Exemplar',
                'headerOptions' => ['width' => '150'],
                'format' => 'html',
                'filter'=> ArrayHelper::map(Exemplar::find()->asArray()->all(),'id','codBarras'),
                'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                'value'=> function ($model) {
                    $titulo = $model->exemplar->obra->titulo;
                    $ano = $model->exemplar->obra->ano;
                    $cota = $model->exemplar->codBarras;
                    $idObra = $model->exemplar->obra->id;

                    return Html::a($titulo.' ('.$ano.') <br>['.$cota.']', ['cat/obra-full', 'id' => $idObra]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'template' => '{view} {fechar} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $id) {
                        return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                            ['value' => Url::to(['presencial-view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonConsultaView' . $id]);
                    },
                    'fechar' => function ($url, $model, $id) {
                        if($model->dataHoraFinal == null)
                        {return Html::button(FAS::icon('check')->size(FAS::SIZE_LG),
                                ['value' => Url::to(['presencial-fechar', 'id' => $id]), 'class' => 'btn btn-success btn-sm', 'id' => 'modalButtonConsultaFechar' . $id]);
                        }else{
                            return Html::button(FAS::icon('check')->size(FAS::SIZE_LG),
                                ['value' => Url::to(['presencial-fechar', 'id' => $id]), 'class' => 'btn btn-success btn-sm disabled', 'id' => 'modalButtonConsultaFechar' . $id]);
                        }
                    },
                    'delete' => function ($url, $model, $id) {
                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['presencial-delete', 'id' => $id]),
                            ['data' => ['confirm' => "Tem a certeza de que pretende apagar a consulta :\n" .'$autor' . ' ?', 'method' => 'post']]);
                    },
                ],
            ],
        ],
    ]); ?>

        </div>
    </div>

    <?php

    Modal::begin([
        'header' => '<h4>Nova Consulta</h4>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    Modal::begin([
        'header' => '<h4></h4>',
        'id' => 'modalView',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();

    ?>
</div>

<?php
    $this->registerJs("
            $(function () {
                if(location.hash == '#go'){
                    $('#rapido-saramago .nav a[href=\"#tab1\"]').tab('show');
                }
            });
    ");
?>
