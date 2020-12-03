<?php

$this->title = 'Associar Funcionário';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipa-create">
    <?= $this->render('_formassociate', [
        'model'=>$model,
        'leitores'=>$leitores])?>
</div>