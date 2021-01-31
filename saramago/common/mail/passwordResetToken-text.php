<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Olá <?= $user->username ?>,<br><br>

Follow the link below to reset your password:<br>

<?= $resetLink ?>
