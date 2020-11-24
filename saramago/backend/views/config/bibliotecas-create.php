
<?php

/* @var $this yii\web\View */
/* @var $model common\models\Biblioteca */

$this->title = 'Nova Biblioteca';
$this->params['breadcrumbs'][] = ['label' => 'Bibliotecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biblioteca-create">
    <?= $this->render('bibliotecas/_form', ['model' => $model,]) ?>
</div>