    <?php

/* @var $this yii\web\View */

use common\models\Exemplar;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Catálogo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-cat">
    <?php
    if($dataProvider->totalCount == 0){
        echo '<div class="alert alert-info alert-dismissible config" role="alert" id="alert-saramago">
                <strong>Informação:</strong> Comece por registar as suas obras.
              </div>';
    }
    ?>
    <div class="grid-container">
        <div class="menu-search-saramago">
            <?php Pjax::begin(); ?>
            <?= $this->render('_search', ['model' => $searchModel, 'cduAll'=>$cduAll, 'colecaoAll'=>$colecaoAll]) ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="menu-nav-saramago">
            <?= Html::button(FAS::icon('plus') . ' Adicionar Obra',
                ['value' => 'cat/create',  'class' => 'btn btn-alt','id' => 'modalButtonCreate']) ?>
            <?= ButtonDropdown::widget([
                'label' => FAS::icon('users') . ' Autores',
                'encodeLabel' => false,
                'options' => ['class' => 'btn btn-alt dropdown-toggle'],
                'dropdown' => [
                    'encodeLabels' => false,
                    'options' => ['class' => 'dropdown-menu-right'],
                    'items' => [
                        [
                            'label' => FAS::icon('plus') . ' Adicionar Autor',
                            'options' => ['value' => 'autor-create', 'class' => 'btn btn-secondary',
                                'id' => 'modalButtonAutorCreate']
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
        <div class="menu-table-saramago">
            <?php Pjax::begin(); ?>
            <?php
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Obras',
                        'content' => '<br>'.
                            GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                //'id',
                                //'imgCapa',
                                [
                                    'label' => 'Título',
                                    'attribute' => 'titulo',
                                    'format' => 'html',
                                    'value' => function ($model) { return Html::a($model->titulo, ['view-full', 'id' => $model->id]);}
                                ],
                                'editor',
                                'edicao',
                                [
                                    'label' => 'Autor/Autores',
                                    'attribute' => 'autor',
                                    'format' => 'html',
                                    'value' => function ($model) { 
                                        foreach ($model->autors as $autor) {
                                            return Html::a($autor->apelido . ', ' . substr($autor->primeiroNome, - strlen($autor->primeiroNome), 1), ['view-full', 'id' => $model->id]);
                                        }
                                    }
                                ],
                                [
                                    'label' => 'Ano',
                                    'attribute' => 'ano',
                                    'headerOptions' => ['width' => '80'],
                                ],
                                [
                                    'attribute' => 'tipoObra',
                                    'label' => 'Tipo',
                                    'filter' => ['Grupo'=> [
                                        'materialAv'=>'Material Audio-Visual',
                                        'monografia'=> 'Monografia',
                                        'pubPeriodica'=>'Publicação Periódica',
                                        'Tipo'=> $tiposExemplarAll],
                                    ],
                                    'filterInputOptions' => ['class' => 'form-control', 'id' => null, 'prompt' => 'Todos'],
                                    'value' => function ($model) {
                                        if($model->tipoObra == 'materialAv'){ return 'Material Audio-Visual';}
                                        elseif ($model->tipoObra == 'monografia'){return 'Monografia';}
                                        elseif ($model->tipoObra == 'pubPeriodica'){return 'Publicação Periódica';}

                                        //TODO Ex: "Material Audio-Visual - CD"
                                    }
                                ],
                                [
                                    'label'=>'Exemplares',
                                    'value' => function ($model) {
                                        $exemplar = Exemplar::find()->where('Obra_id=id')->count();
                                        return $exemplar;}
                                ],
                                //'assuntos',
                                //'preco',
                                //'dataRegisto',
                                //'dataAtualizado',
                                //'Cdu_id',
                                //'Colecao_id',
                                ['class' => 'yii\grid\ActionColumn',
                                    'header' => 'Ações',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model, $id) {
                                            return Html::button(FAS::icon('eye')->size(FAS::SIZE_LG),
                                                ['value' => Url::to(['view', 'id' => $id]), 'class' => 'btn btn-primary btn-sm', 'id' => 'modalButtonView' . $id]);
                                        },
                                        'update' => function ($url, $model, $id) {
                                            return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                                ['value' => Url::to(['update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                                        },
                                        'delete' => function ($url, $model, $id) {
                                            return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                                                ['class' => 'btn btn-danger btn-sm inline']), Url::to(['delete', 'id' => $id]),
                                                ['data' =>
                                                    ['confirm' => 'Tem a certeza de que pretende apagar o leitor ' . $model->titulo . '?', 'method' => 'post']
                                                ]);
                                        },
                                    ],
                                ],
                            ]]),
                        //'options' => ['id' => 'myveryownID'],
                    ],
                    [
                        'label' => 'Autores',
                        'options' => ['id' => 'tabAutores'],
                        'content'=> false,
                    ],
                ],
                'options' => ['class' =>'nav nav-tabs', 'role'=>'tablist'],
            ]);
            ?>

            <?php
            foreach ($obrasModel as $obra) {
                $this->registerJs("
                    $(function () {
                    $('#modalButtonView" . $obra->id . "').click(function (){
                        $('#modalView" . $obra->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
    
                $(function () {
                    $('#modalButtonUpdate" . $obra->id . "').click(function (){
                        $('#modalUpdate" . $obra->id . "').modal('show')
                            .find('#modalContent')
                            .load($(this).attr('value'))
                    })
                });
                ");
            }
            ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
    <br>

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
        'header' => '<h3>Nova Obra</h3>',
        'id' => 'modalCreate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
    Modal::end();
    ?>

    <?php foreach ($obrasModel as $obra) {

        Modal::begin([
            'header' => '<h4>'.$obra->titulo.'</h4>',
            'id' => 'modalView' . $obra->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();

        Modal::begin([
            'header' => '<h4>'.$obra->titulo.'</h4>',
            'id' => 'modalUpdate' . $obra->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
        Modal::end();
    }
    ?>

</div>