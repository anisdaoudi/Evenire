<?php

$oldpwd = $_POST['oldPassword'];
$newpwd = $_POST['newPassword'];
$pwdconfirm = $_POST['passwordConfirm'];

if(empty($newpwd) || empty($oldpwd) || empty($pwdconfirm))
{
    header('location:../password_change.php?error=emptyfield');
    exit();
}

if($newpwd !== $pwdconfirm)
{
    header('location:../password_change.php?error=confirmError');
    exit();
}

$query = $pdo->prepare('select mdp from compte where id_utilisateur = ?');