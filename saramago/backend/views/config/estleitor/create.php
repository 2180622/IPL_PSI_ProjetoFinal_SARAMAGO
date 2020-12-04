<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoLeitor */

$this->title = 'Create Tipo Leitor';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Leitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-leitor-create">

    <?= $this->render('_form', ['model' => $model]) ?>

</div>