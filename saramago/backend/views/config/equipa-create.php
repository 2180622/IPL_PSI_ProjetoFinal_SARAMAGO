<?php

$this->title = 'Novo Funcionário';
$this->params['breadcrumbs'][] = ['label' => 'Bibliotecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biblioteca-create">
    <?= $this->render('equipa/_formcreate', [
        'model'=>$model,
        'listaBibliotecas'=>$listaBibliotecas,
        'listaTiposLeitors'=>$listaTiposLeitors]) ?>
</div>