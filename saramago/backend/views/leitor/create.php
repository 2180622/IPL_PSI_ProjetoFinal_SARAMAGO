<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->title = 'Novo Leitor';
$this->params['breadcrumbs'][] = ['label' => 'Leitores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leitor-create">
    <?= $this->render('_form', [   'model'=>$model,
                                        'listaBibliotecas'=>$listaBibliotecas,
                                        'listaTiposLeitors'=>$listaTiposLeitors,
                                    ]) ?>
</div>
