<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leitor */

$this->title = 'Novo Leitor';
$this->params['breadcrumbs'][] = ['label' => 'Leitores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leitor-create">
    <?php

    if($scenario == 'aluno'){

        echo $this->render('_formAluno/_form', ['model'=>$model, 'listaBibliotecas'=>$listaBibliotecas, 'listaCursos' => $listaCursos]);

    }elseif($scenario == 'docente') {

        echo $this->render('_formDocente/_form', ['model' => $model, 'listaBibliotecas' => $listaBibliotecas]);

    }elseif ($scenario == 'externo'){

        echo $this->render('_formExterno/_form', ['model'=>$model, 'listaBibliotecas'=>$listaBibliotecas]);
    }
     ?>
</div>
