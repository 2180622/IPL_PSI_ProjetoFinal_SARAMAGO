<?php

/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->title = 'Escolha:';
?>

<div>
    <h4 style="text-align: center">
        <p class="pull-left">
            <?= Html::button(FAS::icon('plus').' Adicionar', ['value'=>'equipa-create', 'class' => 'btn btn-create','id'=>'modalButtonCreate']) ?>
        </p>
        <---- Adicionar novo funcionário | Associar um utilizador ---->
        <p class="pull-right">
            <?= Html::button(FAS::icon('plus').' Associar', ['value'=>'equipa-associate', 'class' => 'btn btn-create','id'=>'modalButtonAssociate']) ?>
        </p>
    </h4>
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

    'header' => '<h4>Novo Funcionário</h4>',
    'id' => 'modalCreate',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static']
]);
echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
Modal::end();
?>

<?php
Modal::begin([

    'header' => '<h4>Associar Funcionário</h4>',
    'id' => 'modalAssociate',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static']
]);
echo '<div id="modalContent"><div style="text-align:center">'. FAS::icon('spinner')->size(FAS::SIZE_7X)->spin().'</div></div>';
Modal::end();
?>
