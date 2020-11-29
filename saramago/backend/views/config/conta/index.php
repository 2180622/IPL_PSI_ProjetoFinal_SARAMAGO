<?php


/* @var $this yii\web\View */

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

    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Username',
                'content' => '
                    <div class="alert alert-info alert-dismissible config" role="alert" id="alert-config">
                        <strong>Informação:</strong> Teste.
                    </div>
                ',
                'active' => true
            ],
            [
                'label' => 'Password',
                'content' => 'Anim pariatur cliche...',
                //'headerOptions' => [...],
                'options' => ['id' => 'password'],
            ],
        ],
    ]);
    ?>

</div>