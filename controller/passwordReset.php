<?php
include '../pdo.php';
session_start();


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

$hashedPwd = hash('sha256',$oldpwd);
$userId = $_SESSION['userId']; 

var_dump($userId);
var_dump($hashedPwd);

$query = $pdo->prepare('select * from compte where id_utilisateur = ? and mdp = ?');
$query->execute([$userId,$hashedPwd]);

$userData = $query->fetch();

echo '<pre>';
var_dump($userData);
echo '</pre>';

if(!$userData){
    header('location:../password_change.php?error=wrongPwd');
    exit();
}


$hashedNewPwd = hash('sha256',$newpwd);

$query = $pdo->prepare('UPDATE compte SET mdp = ? WHERE id_utilisateur = ?');
$query->execute([$hashedNewPwd,$userId]);
header('location:../password_change.php?');
