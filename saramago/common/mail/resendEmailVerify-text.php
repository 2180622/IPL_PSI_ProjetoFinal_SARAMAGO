<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
    Olá <?= $user->username ?>,<br><br>

    Siga o link para verificar o seu e-mail:<br><br>

<?= $verifyLink ?>