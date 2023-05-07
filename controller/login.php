<?php
require '../pdo.php';



$email = $_POST['email'];
$password = $_POST['password'];

$hashed_pwd = hash('sha256',$password);

$query = $pdo->prepare("SELECT * FROM compte where email =?");
$query->execute([$email]);

$data = $query->fetchAll();



if(count($data) == 0){
    header('location:../connexion.php?error=accountNotFound');
    exit();
}

unset($data);

$query = $pdo->prepare("SELECT * FROM compte where email =? and mdp=?");
$query->execute([$email,$hashed_pwd]);

$data = $query->fetch();

if(!$data){
    header('location:../connexion.php?error=wrongpwd');
    exit();
}
session_start();



echo ("<pre>");
var_dump($data);
echo ("</pre>");

$_SESSION['userId'] = $data["id_utilisateur"];
$_SESSION["userEmail"] = $data['email'];
$_SESSION["username"] = $data['pseudo'];
$_SESSION["lastname"] = $data['nom'];
$_SESSION["firstname"] = $data['prenom'];
$_SESSION['isAdmin'] = $data['certification'];
$_SESSION['birthdate'] = $data['date_de_naissance'];


var_dump($_SESSION);
header('location:../index.php');
exit();


?>