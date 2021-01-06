<?php


/* @var $this yii\web\View */

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Conta';
$this->params['breadcrumbs'][] = ['label' => 'Administração', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-config config-conta">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php echo '
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Definição</th>
                    <th scope="col" width="50">Ação</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Username</th>
                        <td>' .Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                            ['value'=>Url::to(['config/conta-username']),
                                'class' => 'btn btn-warning btn-sm','id'=>'modalButtonUsername']).'</td>
                </tr>
                <tr>
                    <th>Password</th>
                         <td>'.Html::button(FAS::icon('pencil-alt')->size(FAS::SIZE_LG),
                                ['value'=>Url::to(['config/conta-password']),
                                    'class' => 'btn btn-warning btn-sm','id'=>'modalButtonPassword']).'</td>
                </tr>
            </tbody>
        </table>
    ';
    ?>

    <?php
    $this->registerJs("
        $(function () {
            $('#modalButtonUsername').click(function (){
                $('#modalUsername').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
        
        $(function () {
            $('#modalButtonPassword').click(function (){
                $('#modalPassword').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'))
            })
        });
    ");
    ?>

    <?php

    Modal::begin([

        'header' => '<h4>Username</h4>',
        'id' => 'modalUsername',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">' . FAS::icon('spinner')->size(FAS::SIZE_7X)->spin() . '</div></div>';
    Modal::end();

    ?>

    <?php

    Modal::begin([

        'header' => '<h4>Password</h4>',
        'id' => 'modalPassword',
        'size' => 'modal-md',
        'clientOptions' => ['backdrop' => 'static']
    ]);
    echo '<div id="modalContent"><div style="text-align:center">' . FAS::icon('spinner')->size(FAS::SIZE_7X)->spin() . '</div></div>';
    Modal::end();

    ?>

</div>