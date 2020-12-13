<?php
use yii\helpers\Html;
/** @var $noticia \common\models\Noticias */
?>

<div></div>
<?php

    if ($noticias->count() == 1)
    {
        echo Html::tag('h4','Assunto: '.$noticia->assunto, ['style'=>'bold'])
            .Html::tag('p ',$noticia->conteudo)
            .Html::tag('p ','Autor: '. $noticia->autor, ['class'=>'text-muted']);
    }else{
        foreach ($noticias->all() as $noticia) {
            //FIXME Remover sempre o ultimo <hr> que manda
            echo Html::tag('h4','Assunto: '.$noticia->assunto, ['style'=>'bold'])
                .Html::tag('p ',$noticia->conteudo)
                .Html::tag('p ','Autor: '. $noticia->autor, ['class'=>'text-muted'])
                .Html::tag('hr');
        }
    }
?>
