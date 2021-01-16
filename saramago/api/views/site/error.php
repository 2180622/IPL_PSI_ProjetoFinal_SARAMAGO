<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <h2 class="saramago-login">
        <?=Html::img('@web/res/logo-saramago.png', ['style'=>'vertical-align:text-bottom','height'=>'50‰', 'alt'=>'SARAMAGO']) ?>
        <?= Html::encode('.api') ?>
    </h2>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
