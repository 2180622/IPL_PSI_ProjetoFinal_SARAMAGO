<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->title = 'Editar Leitor Nº' . $model->nome;
?>
<div class="leitor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('updateform', [
        'model' => $model,
        'listaBibliotecas'=>$listaBibliotecas,
        'listaTiposLeitors'=>$listaTiposLeitors,
    ]) ?>

</div>
