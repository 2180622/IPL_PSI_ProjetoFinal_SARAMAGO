<?php


/* @var $this yii\web\View */

use common\models\AuthAssignment;
use common\models\Leitor;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Gestão da Equipa';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-equipa">

    <h1>
        <?= Html::encode($this->title) ?>
        <div class="pull-right">
            <?= ButtonGroup::widget([
                    'encodeLabels' => false,
                    'buttons' => [
                        [
                            'label' => FAS::icon('link').' Associar',
                            'options'=> ['value' => 'equipa-associate','class' => 'btn btn-create', 'id'=>'modalButtonAssociate']
                        ],
                        ButtonDropdown::widget(['label' => '', 'options'=> ['class' => 'btn btn-create dropdown-toggle'],
                                'dropdown' => [
                                        'encodeLabels'=> false,
                                        'options'=>['class'=>'dropdown-menu-right'],
                                        'items' => [
                                            [
                                                'label' => FAS::icon('plus').' Adicionar',
                                                'url'=>Url::toRoute(['leitor/', '#'=>'create']),

                                                /* //TODO Antigo
                                                'label' => FAS::icon('plus').' Adicionar',
                                                'options'=> ['value' => 'equipa-create',
                                                    'class'=>'btn btn-secondary',
                                                    'id'=>'modalButtonCreate']*/
                                            ],
                                        ],],]),],
            ]);?>
        </div>
    </h1>

    <hr>

    <?php
    if ($operadorCount == 0) {
        echo '
            <div class="alert alert-info alert-dismissible config" role="alert">
                <strong>Informação:</strong> Comece por registar um operador.
            </div>
        ';

    } ?>
    <br>

    <?php Pjax::begin(); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Operador',
                'attribute' => 'nome',
                'format' => 'html',
                'value' => function ($model){
                    $leitor = Leitor::find()->where('user_id='.$model->id)->one();
                    return Html::a($leitor->nome, ['leitor/view-full', 'id' => $leitor->id]);}
            ],
            [
                'label' => 'Username',
                'attribute' => 'username',
            ],
            [   'label' => 'E-mail',
                'attribute' => 'email',
            ],
            [   'label' => 'Função',
                'attribute' => 'item_name',
                'filter' => [
                        'admin' => 'ADMIN', 'operadorChefe' => 'Operador Chefe',
                        'operadorCatalogacao'=>'Operador Catalogação', 'operadorCirculacao'=>'Operador Circulação',
                        'leitorFuncionario'=>'Leitor Funcionário', 'leitorAluno'=>'Leitor Aluno', 'leitorExterno'=>'Leitor Externo'
                ],
                'value' => function ($model) {
                    $role = AuthAssignment::find()->where('user_id='.$model->id)->one();
                    return $role->item_name;}
            ],
            [   'label' => 'Status',
                'attribute' => 'status',
                'format' => 'html',
                'filter' => ['10' => 'Ativo', '9' => 'Inativo', '0'=>'Apagado'],
                'value' => function ($model) {
                    if($model->status == 10){return '<h5><span class="label label-success">Ativo</span></h5>';}
                    elseif($model->status == 9){return '<h5><span class="label label-warning">Inativo</span></h5>';}
                    elseif($model->status == 0){return '<h5><span class="label label-danger">Apagado</span></h5>';}
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions' => ['width' => '100'],
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $id) {
                        return Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value' => Url::to(['equipa-update', 'id' => $id]), 'class' => 'btn btn-warning btn-sm', 'id' => 'modalButtonUpdate' . $id]);
                    },
                    'delete' => function ($url, $model, $id) {
                        return Html::a(Html::button(FAS::icon('trash-alt')->size(FAS::SIZE_LG),
                            ['class' => 'btn btn-danger btn-sm inline']), Url::to(['equipa-delete', 'id' => $id]),
                            ['data' => ['confirm' => 'Tem a certeza de que pretende apagar a ' . $model->username . '?', 'method' => 'post']
                            ]);
                    },
                ],
            ],
        ],
    ]);
    ?>

    <?php
    foreach ($operadores as $operador) {
        $this->registerJs("
         
        $(function () {
            $('#modalButtonUpdate" . $operador->id . "').click(function (){
                $('#modalUpdate" . $operador->id . "').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
    ");
    }
    ?>

    <?php Pjax::end(); ?>

    <?php
    $this->registerJs("
        $(function () {
            $('#modalButtonAssociate').click(function (){
                $('#modalAssociate').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");
    ?>

    <?php
    Modal::begin([

        'header' => '<h3>Associar Operador</h3>',
        'id' => 'modalAssociate',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">' . FAS::icon('spinner')->size(FAS::SIZE_7X)->spin() . '</div></div>';
    Modal::end();
    ?>

    <?php foreach ($operadores as $operador) {

        Modal::begin([
            'header' => '<h3>' . $operador->username . '</h3>',
            'id' => 'modalUpdate' . $operador->id,
            'size' => 'modal-lg',
            'clientOptions' => ['backdrop' => 'static']
        ]);
        echo '<div id="modalContent"><div style="text-align:center">' . FAS::icon('spinner')->size(FAS::SIZE_7X)->spin() . '</div></div>';
        Modal::end();
    }
    ?>

</div>