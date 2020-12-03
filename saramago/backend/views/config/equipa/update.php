<?php

$this->title = 'Novo Funcionário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipa-update">
    <?= $this->render('_formupdate', [
        'model' => $model,
        'funcionario'=>$funcionario,
        'leitor'=>$leitor,
        'user'=>$user,
        'listaBibliotecas' => $listaBibliotecas,
        'listaTiposLeitors' => $listaTiposLeitors]) ?>
</div>