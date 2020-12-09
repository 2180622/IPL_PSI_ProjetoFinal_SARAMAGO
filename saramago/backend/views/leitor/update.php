<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->title = 'Editar Leitor Nº' . $model->nome;
?>
<div class="leitor-update">

    <?= $this->render('updateform', [
        'model' => $model,
        'listaBibliotecas'=>$listaBibliotecas,
        'listaTiposLeitors'=>$listaTiposLeitors,
    ]) ?>

</div>
